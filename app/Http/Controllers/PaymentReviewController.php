<?php

namespace App\Http\Controllers;

use App\Models\{Booking, FlightSeat, Notification, Payment, Ticket, User};
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Storage};
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PaymentReviewController extends Controller
{
    private function owner(Request $request, Booking $booking): void
    {
        abort_unless(
            $request->user()->role === 'user'
            && (int) $booking->user_id === (int) $request->user()->id,
            403
        );
    }

    private function admin(Request $request): void
    {
        abort_unless($request->user()->role === 'admin', 403);
    }

    private function fail(string $message): never
    {
        throw ValidationException::withMessages(['review' => $message]);
    }

    private function oldReceipt(Request $request, Booking $booking): ?string
    {
        $report = $request->session()->get('receipt_check');

        if (
            !is_array($report)
            || (int) ($report['booking_id'] ?? 0) !== (int) $booking->id
        ) {
            return null;
        }

        $relative = $report['receipt_path'] ?? '';

        if (
            !is_string($relative)
            || !preg_match('~\Apayment_receipts/[A-Za-z0-9._-]+\z~', $relative)
        ) {
            return null;
        }

        $path = realpath(Storage::disk('public')->path($relative));
        $base = realpath(Storage::disk('public')->path('payment_receipts'));

        if (
            !$path
            || !$base
            || !is_file($path)
            || !str_starts_with($path, $base . DIRECTORY_SEPARATOR)
        ) {
            return null;
        }

        $info = @getimagesize($path);

        return $info
            && in_array($info['mime'], ['image/jpeg', 'image/png'], true)
            && filesize($path) <= 5 * 1024 * 1024
                ? $path
                : null;
    }

    public function customer(Request $request, Booking $booking)
    {
        $this->owner($request, $booking);
        $request->session()->keep('receipt_check');

        $reviews = DB::table('payment_review_requests')
            ->where('booking_id', $booking->id)
            ->where('user_id', $request->user()->id)
            ->orderByDesc('id')
            ->get();

        $hasReceipt = $this->oldReceipt($request, $booking) !== null;

        return view(
            'user.payment-reviews.customer',
            compact('booking', 'reviews', 'hasReceipt')
        );
    }

    public function store(Request $request, Booking $booking)
    {
        $this->owner($request, $booking);
        $request->session()->keep('receipt_check');

        $data = $request->validate([
            'message' => ['required', 'string', 'min:3', 'max:1000'],
            'receipt' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:5120',
            ],
        ]);

        $source = $request->hasFile('receipt')
            ? $request->file('receipt')->getRealPath()
            : $this->oldReceipt($request, $booking);

        if (!$source) {
            $this->fail('Vui lòng chọn ảnh bill JPG hoặc PNG, tối đa 5MB.');
        }

        $info = @getimagesize($source);

        if (
            !$info
            || !in_array($info['mime'], ['image/jpeg', 'image/png'], true)
        ) {
            $this->fail('Ảnh bill không hợp lệ.');
        }

        $privatePath = 'payment-reviews/'
            . Str::uuid()
            . ($info['mime'] === 'image/png' ? '.png' : '.jpg');

        if (
            !Storage::disk('local')->put(
                $privatePath,
                file_get_contents($source)
            )
        ) {
            $this->fail('Chưa lưu được ảnh bill. Vui lòng thử lại.');
        }

        $report = $request->hasFile('receipt')
            ? []
            : ($request->session()->get('receipt_check') ?? []);

        try {
            DB::transaction(function () use (
                $request,
                $booking,
                $data,
                $privatePath,
                $source,
                $report
            ) {
                $locked = Booking::whereKey($booking->id)
                    ->lockForUpdate()
                    ->firstOrFail();

                if ($locked->payment_status === 'paid') {
                    $this->fail('Đơn này đã được thanh toán.');
                }

                if (
                    DB::table('payment_review_requests')
                        ->where('booking_id', $locked->id)
                        ->where('status', 'pending')
                        ->exists()
                ) {
                    $this->fail('Đơn này đã có yêu cầu đang chờ xử lý.');
                }

                $id = DB::table('payment_review_requests')->insertGetId([
                    'booking_id' => $locked->id,
                    'user_id' => $request->user()->id,
                    'booking_code' => $locked->booking_code,
                    'expected_amount' => $locked->total_amount,
                    'receipt_path' => $privatePath,
                    'receipt_sha256' => hash_file('sha256', $source),
                    'transaction_code' => $report['transaction_code'] ?? null,
                    'receipt_content' => $report['read_content'] ?? null,
                    'ocr_text' => $report['ocr_text'] ?? null,
                    'message' => $data['message'],
                    'status' => 'pending',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                foreach (User::where('role', 'admin')->get() as $admin) {
                    Notification::create([
                        'user_id' => $admin->id,
                        'sender_id' => $request->user()->id,
                        'ticket_id' => $locked->tickets()->first()?->id,
                        'title' => 'Yêu cầu đối soát thanh toán mới',
                        'message' => 'Đơn '
                            . $locked->booking_code
                            . ' có yêu cầu đối soát #'
                            . $id
                            . '. Mở mục Xử lý thanh toán để kiểm tra.',
                        'status' => 'unread',
                    ]);
                }
            }, 3);
        } catch (\Throwable $e) {
            Storage::disk('local')->delete($privatePath);
            throw $e;
        }

        return redirect()
            ->route('payment-reviews.customer', $booking->id)
            ->with(
                'success',
                'Đã gửi yêu cầu đối soát. Bạn không cần chuyển tiền lại.'
            );
    }

    public function index(Request $request)
    {
        $this->admin($request);

        $data = $request->validate([
            'status' => ['nullable', 'in:pending,approved,rejected'],
            'keyword' => ['nullable', 'string', 'max:80'],
        ]);

        $status = $request->query->has('status')
            ? ($data['status'] ?? '')
            : 'pending';

        $keyword = trim($data['keyword'] ?? '');

        $query = DB::table('payment_review_requests as r')
            ->leftJoin('users as u', 'u.id', '=', 'r.user_id')
            ->select('r.*', 'u.name as customer_name');

        if ($status !== '') {
            $query->where('r.status', $status);
        }

        if ($keyword !== '') {
            $query->where('r.booking_code', 'like', '%' . $keyword . '%');
        }

        $reviews = $query->orderByDesc('r.id')
            ->paginate(15)
            ->withQueryString();

        // Danh sách và chi tiết cùng dùng một file Blade.
        $review = null;
        $booking = null;

        return view(
            'admin.payment-reviews.index',
            compact('reviews', 'status', 'keyword', 'review', 'booking')
        );
    }

    public function show(Request $request, int $reviewId)
    {
        $this->admin($request);

        $review = DB::table('payment_review_requests as r')
            ->leftJoin('users as u', 'u.id', '=', 'r.user_id')
            ->leftJoin('users as a', 'a.id', '=', 'r.reviewed_by')
            ->select(
                'r.*',
                'u.name as customer_name',
                'a.name as reviewer_name'
            )
            ->where('r.id', $reviewId)
            ->first();

        abort_unless($review, 404);

        $booking = Booking::with([
            'tickets.flight.departureAirport',
            'tickets.flight.arrivalAirport',
            'tickets.flightSeat',
        ])->find($review->booking_id);

        // Dùng chung file giao diện với trang danh sách.
        return view(
            'admin.payment-reviews.index',
            compact('review', 'booking')
        );
    }

    public function image(Request $request, int $reviewId)
    {
        $review = DB::table('payment_review_requests')
            ->where('id', $reviewId)
            ->first();

        abort_unless($review, 404);

        abort_unless(
            $request->user()->role === 'admin'
            || (int) $request->user()->id === (int) $review->user_id,
            403
        );

        abort_unless(
            preg_match(
                '~\Apayment-reviews/[a-f0-9-]+\.(?:jpg|png)\z~',
                $review->receipt_path
            )
            && Storage::disk('local')->exists($review->receipt_path),
            404
        );

        return response()->file(
            Storage::disk('local')->path($review->receipt_path),
            [
                'X-Content-Type-Options' => 'nosniff',
                'Cache-Control' => 'private, no-store',
            ]
        );
    }

    public function decide(Request $request, int $reviewId)
    {
        $this->admin($request);

        $data = $request->validate([
            'decision' => ['required', 'in:approve,reject'],
            'note' => ['required', 'string', 'min:3', 'max:1000'],
            'transaction_code' => [
                'nullable',
                'required_if:decision,approve',
                'string',
                'regex:/\A[A-Za-z0-9-]{6,80}\z/',
            ],
            'received_amount' => [
                'nullable',
                'required_if:decision,approve',
                'integer',
                'min:1',
            ],
            'bank_confirmed' => $request->input('decision') === 'approve'
                ? ['required', 'accepted']
                : ['nullable'],
        ]);

        $initial = DB::table('payment_review_requests')
            ->where('id', $reviewId)
            ->first();

        abort_unless($initial, 404);

        try {
            DB::transaction(function () use (
                $initial,
                $reviewId,
                $request,
                $data
            ) {
                // Cùng thứ tự khóa với luồng hết hạn: đơn -> vé -> ghế.
                $booking = Booking::whereKey($initial->booking_id)
                    ->lockForUpdate()
                    ->first();

                $review = DB::table('payment_review_requests')
                    ->where('id', $reviewId)
                    ->lockForUpdate()
                    ->first();

                if (!$review || $review->status !== 'pending') {
                    $this->fail(
                        'Yêu cầu đã được xử lý. Không thể xử lý lần nữa.'
                    );
                }

                $transactionCode = strtoupper(
                    $data['transaction_code'] ?? ''
                );

                if ($data['decision'] === 'approve') {
                    if (
                        !$booking
                        || $booking->booking_status !== 'pending'
                        || $booking->payment_status !== 'unpaid'
                    ) {
                        $this->fail(
                            'Đơn không còn chờ thanh toán. Không kích hoạt lại vé đã hủy hoặc đã thanh toán.'
                        );
                    }

                    if (
                        !$booking->expires_at
                        || $booking->expires_at->isPast()
                    ) {
                        $this->fail(
                            'Đơn đã hết hạn giữ ghế. Cần xử lý ghế hoặc hoàn tiền riêng, không duyệt kích hoạt vé này.'
                        );
                    }

                    if (
                        (int) $data['received_amount']
                            !== (int) $booking->total_amount
                        || (int) $review->expected_amount
                            !== (int) $booking->total_amount
                    ) {
                        $this->fail(
                            'Số tiền thực nhận phải khớp tổng tiền đơn và số tiền lúc gửi yêu cầu.'
                        );
                    }

                    if (
                        Payment::where(
                            'receipt_transaction_code',
                            $transactionCode
                        )->exists()
                    ) {
                        $this->fail(
                            'Mã giao dịch đã được dùng. Không duyệt cho đơn khác.'
                        );
                    }

                    if (
                        DB::table('payment_review_requests')
                            ->where('receipt_sha256', $review->receipt_sha256)
                            ->where('status', 'approved')
                            ->exists()
                    ) {
                        $this->fail(
                            'Ảnh bill này đã được duyệt cho yêu cầu khác.'
                        );
                    }

                    $tickets = Ticket::where('booking_id', $booking->id)
                        ->orderBy('id')
                        ->lockForUpdate()
                        ->get();

                    if (
                        $tickets->isEmpty()
                        || $tickets->contains(
                            fn ($ticket) => $ticket->ticket_status !== 'pending'
                        )
                    ) {
                        $this->fail(
                            'Vé không còn ở trạng thái chờ thanh toán.'
                        );
                    }

                    $seatIds = $tickets->pluck('flight_seat_id')->unique();

                    $seats = FlightSeat::whereIn('id', $seatIds)
                        ->orderBy('id')
                        ->lockForUpdate()
                        ->get()
                        ->keyBy('id');

                    foreach ($tickets as $ticket) {
                        $seat = $seats->get($ticket->flight_seat_id);

                        if (
                            !$seat
                            || $seat->status !== 'booked'
                            || (int) $seat->flight_id
                                !== (int) $ticket->flight_id
                        ) {
                            $this->fail(
                                'Ghế không còn được giữ hợp lệ cho đơn này.'
                            );
                        }

                        if (
                            Ticket::where('flight_seat_id', $seat->id)
                                ->where('booking_id', '!=', $booking->id)
                                ->whereIn(
                                    'ticket_status',
                                    ['pending', 'active', 'used']
                                )
                                ->exists()
                        ) {
                            $this->fail(
                                'Ghế đang gắn với vé khác. Không thể kích hoạt.'
                            );
                        }

                        $flight = $ticket->flight;

                        if (
                            !$flight
                            || $flight->status !== 'open'
                            || Carbon::parse(
                                $flight->flight_date->format('Y-m-d')
                                    . ' '
                                    . $flight->departure_time,
                                config('app.timezone')
                            )->isPast()
                        ) {
                            $this->fail(
                                'Chuyến bay không còn mở hoặc đã đến giờ khởi hành.'
                            );
                        }
                    }

                    Payment::create([
                        'booking_id' => $booking->id,
                        'payment_code' => 'PAY' . Str::upper(Str::random(10)),
                        'amount' => $booking->total_amount,
                        'payment_method' => 'bank_transfer_review',
                        'payment_status' => 'paid',
                        'receipt_image' => null,
                        'receipt_transaction_code' => $transactionCode,
                        'receipt_content' => $review->receipt_content,
                        'receipt_amount' => (int) $data['received_amount'],
                        'ocr_text' => $review->ocr_text,
                        'paid_at' => now(),
                    ]);

                    $booking->update([
                        'payment_status' => 'paid',
                        'booking_status' => 'confirmed',
                        'expires_at' => null,
                    ]);

                    Ticket::where('booking_id', $booking->id)
                        ->update(['ticket_status' => 'active']);
                }

                $approved = $data['decision'] === 'approve';

                DB::table('payment_review_requests')
                    ->where('id', $reviewId)
                    ->update([
                        'status' => $approved ? 'approved' : 'rejected',
                        'reviewed_by' => $request->user()->id,
                        'reviewed_at' => now(),
                        'reviewer_note' => $data['note'],
                        'approved_transaction_code' => $approved
                            ? $transactionCode
                            : null,
                        'approved_receipt_sha256' => $approved
                            ? $review->receipt_sha256
                            : null,
                        'received_amount' => $approved
                            ? (int) $data['received_amount']
                            : null,
                        'updated_at' => now(),
                    ]);

                if (
                    $review->user_id
                    && User::whereKey($review->user_id)->exists()
                ) {
                    Notification::create([
                        'user_id' => $review->user_id,
                        'sender_id' => $request->user()->id,
                        'ticket_id' => $booking?->tickets()->first()?->id,
                        'title' => $approved
                            ? 'Đối soát thanh toán được duyệt'
                            : 'Kết quả đối soát thanh toán',
                        'message' => 'Đơn '
                            . $review->booking_code
                            . ': '
                            . $data['note'],
                        'status' => 'unread',
                    ]);
                }
            }, 3);
        } catch (\Illuminate\Database\QueryException $e) {
            if (
                in_array(
                    (string) $e->getCode(),
                    ['23000', '23505'],
                    true
                )
            ) {
                $this->fail(
                    'Giao dịch hoặc ảnh bill vừa được dùng. Vui lòng tải lại trang để kiểm tra.'
                );
            }

            throw $e;
        }

        return redirect()
            ->route('admin.payment-reviews.show', $reviewId)
            ->with(
                'success',
                $data['decision'] === 'approve'
                    ? 'Đã duyệt đối soát và kích hoạt vé.'
                    : 'Đã từ chối yêu cầu và lưu lý do.'
            );
    }
}