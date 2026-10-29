from pathlib import Path
from datetime import datetime
import shutil

FILES = {
'app/Http/Controllers/PaymentReviewController.php': r"""<?php

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
            'payment-reviews.customer',
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
                    $this->fail(
                        'Đơn này đã có yêu cầu đang chờ xử lý.'
                    );
                }

                $id = DB::table('payment_review_requests')
                    ->insertGetId([
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
                            . '. Mở mục Đối soát thanh toán để kiểm tra.',
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

        return view(
            'payment-reviews.index',
            compact('reviews', 'status', 'keyword')
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

        return view(
            'payment-reviews.show',
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

                    $tickets = Ticket::where(
                        'booking_id',
                        $booking->id
                    )->orderBy('id')->lockForUpdate()->get();

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
""",

'database/migrations/2026_10_26_100000_create_payment_review_requests_table.php': r"""<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payment_review_requests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('booking_id')
                ->constrained('bookings')
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('booking_code');
            $table->decimal('expected_amount', 12, 0);
            $table->string('receipt_path');
            $table->string('receipt_sha256', 64)->index();
            $table->string('transaction_code')->nullable();
            $table->text('receipt_content')->nullable();
            $table->longText('ocr_text')->nullable();
            $table->text('message');
            $table->string('status', 20)->default('pending')->index();

            $table->foreignId('reviewed_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('reviewed_at')->nullable();
            $table->text('reviewer_note')->nullable();
            $table->string('approved_transaction_code')->nullable();
            $table->string('approved_receipt_sha256', 64)->nullable()->unique();
            $table->decimal('received_amount', 12, 0)->nullable();
            $table->timestamps();
            $table->index(['booking_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_review_requests');
    }
};
""",

'routes/payment-reviews.php': r"""<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentReviewController;

Route::middleware('auth')->group(function () {
    Route::get(
        '/doi-soat-thanh-toan/{booking}',
        [PaymentReviewController::class, 'customer']
    )->name('payment-reviews.customer');

    Route::post(
        '/doi-soat-thanh-toan/{booking}',
        [PaymentReviewController::class, 'store']
    )->middleware('throttle:10,1')->name('payment-reviews.store');

    Route::get(
        '/doi-soat-thanh-toan/anh/{reviewId}',
        [PaymentReviewController::class, 'image']
    )->whereNumber('reviewId')->name('payment-reviews.image');

    Route::middleware('admin')
        ->prefix('admin/doi-soat-thanh-toan')
        ->group(function () {
            Route::get(
                '/',
                [PaymentReviewController::class, 'index']
            )->name('admin.payment-reviews.index');

            Route::get(
                '/{reviewId}',
                [PaymentReviewController::class, 'show']
            )->whereNumber('reviewId')->name('admin.payment-reviews.show');

            Route::post(
                '/{reviewId}',
                [PaymentReviewController::class, 'decide']
            )->whereNumber('reviewId')->name('admin.payment-reviews.decide');
        });
});
""",

'resources/views/payment-reviews/layout.blade.php': r"""<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đối soát thanh toán - VietJet</title>
    <style>
        *{box-sizing:border-box}
        body{margin:0;background:#f3f6fa;color:#243746;font:14px Arial,sans-serif}
        a{color:#003b70;text-decoration:none}
        .sidebar{position:fixed;inset:0 auto 0 0;width:240px;overflow:auto;background:#00294f;padding:28px 14px;color:white}
        .logo{display:block;font-size:29px;font-weight:bold;color:white;padding:5px 12px 25px}
        .logo span{color:#f4b400}
        .menu-link{display:flex;align-items:center;gap:12px;color:#dfebf5;padding:13px 12px;margin:5px 0;border-radius:7px;font-size:13px;font-weight:bold}
        .menu-link.active,.menu-link:hover{background:#204a6e}
        .menu-link.active{color:#f4b400}
        .menu-link svg{width:18px;height:18px;fill:none;stroke:currentColor;stroke-width:1.7;flex-shrink:0}
        .page{margin-left:240px}
        .topbar{padding:20px 28px;background:white;border-bottom:1px solid #dce5ed;display:flex;justify-content:space-between;gap:15px;align-items:center}
        .content{padding:26px 28px;max-width:1700px;margin:auto}
        .card{background:white;border:1px solid #dce5ed;border-radius:11px;padding:22px;margin-bottom:20px}
        h1{color:#003b70;font-size:26px;margin:0 0 12px}
        h2{font-size:19px;color:#003b70;margin:0 0 15px}
        p{line-height:1.7}
        .muted{color:#64748b;font-size:12px}
        .button,button{display:inline-flex;align-items:center;justify-content:center;padding:11px 16px;border:0;border-radius:6px;background:#003b70;color:white;font:600 13px Arial;cursor:pointer}
        .secondary{background:#edf5fb;color:#003b70}
        .danger{background:#b42318}
        .buttons{display:flex;gap:10px;flex-wrap:wrap;align-items:center}
        .filters{display:flex;gap:15px;flex-wrap:wrap;align-items:end}
        label{display:block;font-size:13px;font-weight:bold;margin:12px 0 7px}
        input:not([type=checkbox]),select,textarea{padding:11px;border:1px solid #cbd5e1;border-radius:6px;font:14px Arial;max-width:100%;width:100%}
        textarea{min-height:100px;resize:vertical}
        input[type=checkbox]{width:17px;height:17px;vertical-align:middle}
        .checkbox{line-height:1.8}
        .scroll{overflow:auto}
        table{width:100%;border-collapse:collapse;font-size:13px}
        th,td{padding:13px 11px;text-align:left;border-bottom:1px solid #e3eaf0;vertical-align:top;line-height:1.6}
        th{background:#edf5fb;color:#003b70;white-space:nowrap}
        .badge{display:inline-block;padding:4px 8px;border-radius:5px;white-space:nowrap;background:#fff4e5;color:#854d0e}
        .approved{background:#eaf7f0;color:#146c43}
        .rejected{background:#fdebed;color:#b42318}
        .success,.errors,.notice{padding:15px;border-radius:7px;line-height:1.7;margin-bottom:18px}
        .success{background:#eaf7f0;color:#146c43}
        .errors{background:#fdebed;color:#842029}
        .notice{background:#fff4e5;color:#854d0e}
        .grid{display:grid;grid-template-columns:minmax(0,1fr) minmax(0,1fr);gap:20px}
        .bill{width:100%;max-height:650px;object-fit:contain;border:1px solid #e3eaf0;border-radius:7px}
        .nowrap{white-space:nowrap}
        pre{white-space:pre-wrap;overflow-wrap:anywhere;font-size:12px;max-height:220px;overflow:auto}
        .pagination{display:flex;gap:15px;align-items:center;justify-content:space-between;margin-top:20px}
        .user .page{margin-left:0}
        .user .content{max-width:1200px}
        .user .topbar{background:#00294f;color:white}
        .user .topbar a{color:white}
        .user .logo{padding:0;font-size:25px}
        .decision{border-top:1px solid #e3eaf0;margin-top:25px;padding-top:20px}
        @media(max-width:850px){
            .grid{grid-template-columns:1fr}
            .sidebar{position:static;width:100%}
            .sidebar nav{display:flex;overflow:auto}
            .menu-link{white-space:nowrap}
            .page{margin-left:0}
            .content{padding:20px 14px}
            .topbar{padding:18px 14px;flex-wrap:wrap}
        }
    </style>
</head>
<body class="{{ auth()->user()->role === 'admin' ? 'admin' : 'user' }}">
@if(auth()->user()->role === 'admin')
    <aside class="sidebar">
        <a class="logo" href="{{ route('admin.trang-chu') }}">
            Viet<span>Jet</span>
        </a>

        @php
            $menus = [
                ['admin.trang-chu', 'Tổng quan'],
                ['admin.airports.index', 'Quản lý sân bay'],
                ['admin.aircraft.index', 'Quản lý máy bay'],
                ['admin.flights.index', 'Quản lý chuyến bay'],
                ['admin.bookings.index', 'Quản lý vé'],
                ['admin.users.index', 'Quản lý người dùng'],
                ['admin.employees.index', 'Quản lý nhân viên'],
                ['admin.check-ins.index', 'Lịch sử check-in'],
                ['admin.payment-reviews.index', 'Đối soát thanh toán'],
                ['admin.baggage.index', 'Quản lý hành lý'],
                ['admin.statistics.index', 'Thống kê chi tiết'],
                ['admin.settings.edit', 'Quản lý đổi giá vé'],
                ['admin.refund-settings.edit', 'Quản lý hoàn vé'],
            ];
        @endphp

        <nav aria-label="Menu admin">
            @foreach($menus as [$menuRoute, $menuName])
                <a
                    class="menu-link {{ $menuRoute === 'admin.payment-reviews.index' ? 'active' : '' }}"
                    href="{{ route($menuRoute) }}"
                >
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <rect x="3" y="5" width="18" height="14" rx="2"/>
                        <path d="M3 10h18M7 15h5"/>
                    </svg>
                    {{ $menuName }}
                </a>
            @endforeach
        </nav>
    </aside>
@endif

<div class="page">
    <header class="topbar">
        @if(auth()->user()->role === 'admin')
            <strong>VietJet Administration — Đối soát thanh toán</strong>
            <a href="{{ route('admin.bookings.index') }}">Quản lý vé</a>
        @else
            <a class="logo" href="{{ route('trang-chu') }}">
                Viet<span>Jet</span>
            </a>
            <a href="{{ route('tickets.mine') }}">Vé của tôi</a>
        @endif
    </header>

    <main class="content">
        @if(session('success'))
            <div class="success" role="status">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="errors" role="alert">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @yield('content')
    </main>
</div>
</body>
</html>
""",

'resources/views/payment-reviews/request-button.blade.php': r"""@if(
    auth()->check()
    && auth()->user()->role === 'user'
    && (int) $booking->user_id === (int) auth()->id()
    && $booking->payment_status !== 'paid'
    && (int) data_get(session('receipt_check'), 'booking_id', 0) === (int) $booking->id
)
    <section style="margin:18px 0;padding:20px;border:1px solid #dbe4ed;border-radius:10px;background:#fff">
        <strong style="color:#003b70">
            Bạn đã chuyển tiền nhưng hóa đơn chưa được duyệt?
        </strong>

        <p style="font-size:13px;line-height:1.7;margin:10px 0">
            Gửi yêu cầu để admin đối soát giao dịch với đơn đặt vé.
            Bạn không cần chuyển tiền lại.
        </p>

        <a
            href="{{ route('payment-reviews.customer', $booking->id) }}"
            style="display:inline-block;padding:12px 18px;border-radius:6px;background:#003b70;color:white;font-size:13px;font-weight:bold"
        >
            Đã chuyển tiền? Gửi yêu cầu đối soát
        </a>
    </section>
@endif
""",

'resources/views/payment-reviews/customer.blade.php': r"""@extends('payment-reviews.layout')

@section('content')
<h1>Đối soát thanh toán</h1>

<section class="card">
    <h2>Đơn đặt vé {{ $booking->booking_code }}</h2>

    <p>
        Số tiền đơn:
        <strong>{{ number_format($booking->total_amount, 0, ',', '.') }}đ</strong>
    </p>

    <p>
        Trạng thái thanh toán:
        <strong>
            {{ $booking->payment_status === 'paid' ? 'Đã thanh toán' : 'Chưa xác minh thanh toán' }}
        </strong>
    </p>

    <div class="notice">
        Gửi yêu cầu không gia hạn giữ ghế.
        Nếu đơn đã hết hạn hoặc đã hủy, admin cần xử lý ghế
        hoặc hoàn tiền riêng. Bạn không cần chuyển tiền lại.
    </div>

    @if($booking->payment_status === 'paid')
        <a class="button" href="{{ route('ticket.show', $booking->id) }}">
            Xem vé điện tử
        </a>
    @elseif(!$reviews->contains('status', 'pending'))
        <form
            method="POST"
            action="{{ route('payment-reviews.store', $booking->id) }}"
            enctype="multipart/form-data"
        >
            @csrf

            @if($hasReceipt)
                <p>
                    Hệ thống đang giữ bill bạn vừa tải.
                    Bạn có thể gửi lại bill này hoặc chọn ảnh khác bên dưới.
                </p>
            @endif

            <label for="receipt">
                {{ $hasReceipt ? 'Chọn bill khác nếu cần' : 'Ảnh bill chuyển khoản' }}
            </label>

            <input
                id="receipt"
                name="receipt"
                type="file"
                accept="image/jpeg,image/png"
                @required(!$hasReceipt)
            >

            <p class="muted">Ảnh JPG hoặc PNG, tối đa 5MB.</p>

            <label for="message">Lời nhắn cho admin</label>

            <textarea
                id="message"
                name="message"
                required
                minlength="3"
                maxlength="1000"
                placeholder="Ví dụ: Tôi đã chuyển tiền nhưng ghi nhầm nội dung. Nhờ admin kiểm tra giúp."
            >{{ old('message') }}</textarea>

            <div class="buttons" style="margin-top:16px">
                <button type="submit">Gửi yêu cầu đối soát</button>
                <a class="button secondary" href="{{ route('tickets.mine') }}">
                    Vé của tôi
                </a>
            </div>
        </form>
    @else
        <p>
            <strong>Yêu cầu của bạn đang chờ admin xử lý.</strong>
            Kết quả sẽ hiển thị tại đây và trong thông báo.
        </p>
    @endif
</section>

<section class="card">
    <h2>Các yêu cầu của đơn này</h2>

    <div class="scroll">
        <table>
            <thead>
                <tr>
                    <th>Yêu cầu</th>
                    <th>Ngày gửi</th>
                    <th>Bill</th>
                    <th>Lời nhắn</th>
                    <th>Trạng thái</th>
                    <th>Kết quả từ admin</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reviews as $review)
                    <tr>
                        <td>#{{ $review->id }}</td>

                        <td class="nowrap">
                            {{ \Carbon\Carbon::parse($review->created_at, config('app.timezone'))->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s') }}
                        </td>

                        <td>
                            <a
                                href="{{ route('payment-reviews.image', $review->id) }}"
                                target="_blank"
                                rel="noopener"
                            >Xem bill</a>
                        </td>

                        <td>{{ $review->message }}</td>

                        <td>
                            <span class="badge {{ $review->status }}">
                                {{ ['pending'=>'Chờ xử lý','approved'=>'Đã duyệt','rejected'=>'Đã từ chối'][$review->status] ?? $review->status }}
                            </span>
                        </td>

                        <td>
                            {{ $review->reviewer_note ?? 'Chưa có kết quả' }}

                            @if($review->reviewed_at)
                                <br>
                                <span class="muted">
                                    {{ \Carbon\Carbon::parse($review->reviewed_at, config('app.timezone'))->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s') }}
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Chưa có yêu cầu đối soát.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection
""",

'resources/views/payment-reviews/index.blade.php': r"""@extends('payment-reviews.layout')

@section('content')
<h1>Yêu cầu đối soát thanh toán</h1>

<section class="card">
    <form
        method="GET"
        action="{{ route('admin.payment-reviews.index') }}"
        class="filters"
    >
        <div>
            <label for="keyword">Mã đặt vé</label>
            <input
                id="keyword"
                name="keyword"
                value="{{ $keyword }}"
                maxlength="80"
            >
        </div>

        <div>
            <label for="status">Trạng thái yêu cầu</label>
            <select id="status" name="status">
                <option value="">Tất cả</option>

                @foreach(['pending'=>'Chờ xử lý','approved'=>'Đã duyệt','rejected'=>'Đã từ chối'] as $value=>$label)
                    <option value="{{ $value }}" @selected($status === $value)>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit">Lọc</button>

        <a
            class="button secondary"
            href="{{ route('admin.payment-reviews.index') }}"
        >Chờ xử lý</a>
    </form>
</section>

<section class="card">
    <p>
        Tổng cộng:
        <strong>{{ $reviews->total() }}</strong>
        yêu cầu theo bộ lọc.
    </p>

    <div class="scroll">
        <table>
            <thead>
                <tr>
                    <th>Yêu cầu</th>
                    <th>Đơn đặt vé</th>
                    <th>Khách hàng</th>
                    <th>Số tiền đơn</th>
                    <th>Ngày gửi</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>

            <tbody>
                @forelse($reviews as $review)
                    <tr>
                        <td>#{{ $review->id }}</td>
                        <td>{{ $review->booking_code }}</td>
                        <td>{{ $review->customer_name ?? '---' }}</td>

                        <td>
                            {{ number_format($review->expected_amount, 0, ',', '.') }}đ
                        </td>

                        <td class="nowrap">
                            {{ \Carbon\Carbon::parse($review->created_at, config('app.timezone'))->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s') }}
                        </td>

                        <td>
                            <span class="badge {{ $review->status }}">
                                {{ ['pending'=>'Chờ xử lý','approved'=>'Đã duyệt','rejected'=>'Đã từ chối'][$review->status] ?? $review->status }}
                            </span>
                        </td>

                        <td>
                            <a
                                class="button secondary"
                                href="{{ route('admin.payment-reviews.show', $review->id) }}"
                            >Xem chi tiết</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">Không có yêu cầu phù hợp.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($reviews->hasPages())
        <div class="pagination">
            <div>
                @if($reviews->previousPageUrl())
                    <a href="{{ $reviews->previousPageUrl() }}">← Trang trước</a>
                @endif
            </div>

            <span>
                Trang {{ $reviews->currentPage() }} / {{ $reviews->lastPage() }}
            </span>

            <div>
                @if($reviews->nextPageUrl())
                    <a href="{{ $reviews->nextPageUrl() }}">Trang sau →</a>
                @endif
            </div>
        </div>
    @endif
</section>
@endsection
""",

'resources/views/payment-reviews/show.blade.php': r"""@extends('payment-reviews.layout')

@section('content')
<h1>Đối soát #{{ $review->id }} — {{ $review->booking_code }}</h1>

<p>
    <a href="{{ route('admin.payment-reviews.index') }}">
        ← Danh sách yêu cầu
    </a>
</p>

<div class="grid">
    <section class="card">
        <h2>Ảnh bill khách gửi</h2>

        <a
            href="{{ route('payment-reviews.image', $review->id) }}"
            target="_blank"
            rel="noopener"
        >
            <img
                class="bill"
                src="{{ route('payment-reviews.image', $review->id) }}"
                alt="Bill chuyển khoản khách gửi đối soát"
            >
        </a>

        <p class="muted">Bấm ảnh để xem kích thước đầy đủ.</p>
    </section>

    <section class="card">
        <h2>Thông tin đối soát</h2>

        <p>
            Khách hàng:
            <strong>{{ $review->customer_name ?? '---' }}</strong>
        </p>

        <p>
            Số tiền lúc gửi yêu cầu:
            <strong>{{ number_format($review->expected_amount, 0, ',', '.') }}đ</strong>
        </p>

        <p>
            Nội dung yêu cầu của đơn:
            <strong>VJ {{ $review->booking_code }}</strong>
        </p>

        <p>
            Nội dung OCR ghi nhận:
            <strong>{{ $review->receipt_content ?? 'Chưa đọc được / khách chọn ảnh mới' }}</strong>
        </p>

        <p>
            Mã giao dịch OCR ghi nhận:
            <strong>{{ $review->transaction_code ?? 'Chưa đọc được / khách chọn ảnh mới' }}</strong>
        </p>

        <p>Lời nhắn: {{ $review->message }}</p>

        <p>
            Trạng thái yêu cầu:
            <span class="badge {{ $review->status }}">
                {{ ['pending'=>'Chờ xử lý','approved'=>'Đã duyệt','rejected'=>'Đã từ chối'][$review->status] ?? $review->status }}
            </span>
        </p>

        @if($booking)
            <p>
                Đơn hiện tại:
                {{ $booking->booking_status }} / {{ $booking->payment_status }}
            </p>

            <a
                class="button secondary"
                href="{{ route('admin.bookings.show', $booking->id) }}"
            >Xem đơn vé</a>

            @if(
                $booking->booking_status !== 'pending'
                || $booking->payment_status !== 'unpaid'
                || !$booking->expires_at
                || $booking->expires_at->isPast()
            )
                <div class="notice" style="margin-top:15px">
                    Đơn không còn đủ điều kiện giữ ghế để duyệt kích hoạt vé.
                    Nếu khách đã chuyển tiền, cần xử lý ghế hoặc hoàn tiền riêng.
                </div>
            @endif
        @endif

        @if($review->reviewed_at)
            <div class="notice" style="margin-top:15px">
                <strong>Kết quả xử lý</strong>

                <p>{{ $review->reviewer_note }}</p>

                <p>
                    Người xử lý: {{ $review->reviewer_name ?? '---' }}
                    <br>
                    {{ \Carbon\Carbon::parse($review->reviewed_at, config('app.timezone'))->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s') }}
                </p>

                @if($review->approved_transaction_code)
                    <p>
                        Mã giao dịch đã duyệt:
                        {{ $review->approved_transaction_code }}
                        <br>
                        Thực nhận:
                        {{ number_format($review->received_amount, 0, ',', '.') }}đ
                    </p>
                @endif
            </div>
        @endif
    </section>
</div>

@if($booking)
    <section class="card">
        <h2>Vé trong đơn</h2>

        <div class="scroll">
            <table>
                <thead>
                    <tr>
                        <th>Mã vé</th>
                        <th>Hành khách</th>
                        <th>Chuyến bay</th>
                        <th>Hành trình</th>
                        <th>Ngày bay</th>
                        <th>Ghế</th>
                        <th>Trạng thái vé</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($booking->tickets as $ticket)
                        <tr>
                            <td>{{ $ticket->ticket_code }}</td>
                            <td>{{ $ticket->passenger_name }}</td>
                            <td>{{ $ticket->flight?->flight_code ?? '---' }}</td>

                            <td>
                                {{ $ticket->flight?->departureAirport?->city ?? '---' }}
                                →
                                {{ $ticket->flight?->arrivalAirport?->city ?? '---' }}
                            </td>

                            <td>
                                {{ $ticket->flight?->flight_date?->format('d/m/Y') ?? '---' }}
                            </td>

                            <td>{{ $ticket->flightSeat?->seat_number ?? '---' }}</td>
                            <td>{{ $ticket->ticket_status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endif

@if($review->status === 'pending')
    <section class="card">
        <h2>Xử lý yêu cầu</h2>

        <p class="notice">
            Chỉ duyệt sau khi đã kiểm tra giao dịch nhận tiền.
            Bill sai nội dung không được tự xem là bằng chứng
            tiền đã vào tài khoản.
        </p>

        @if(
            $booking
            && $booking->booking_status === 'pending'
            && $booking->payment_status === 'unpaid'
            && $booking->expires_at
            && !$booking->expires_at->isPast()
        )
            <form
                method="POST"
                action="{{ route('admin.payment-reviews.decide', $review->id) }}"
            >
                @csrf
                <input type="hidden" name="decision" value="approve">

                <label for="transaction_code">Mã giao dịch đã đối soát</label>
                <input
                    id="transaction_code"
                    name="transaction_code"
                    value="{{ old('transaction_code', $review->transaction_code) }}"
                    required
                    minlength="6"
                    maxlength="80"
                    pattern="[A-Za-z0-9-]{6,80}"
                >

                <label for="received_amount">Số tiền thực nhận (đồng)</label>
                <input
                    id="received_amount"
                    name="received_amount"
                    type="number"
                    min="1"
                    step="1"
                    value="{{ old('received_amount') }}"
                    required
                >

                <label for="approve_note">Ghi chú duyệt</label>
                <textarea
                    id="approve_note"
                    name="note"
                    required
                    minlength="3"
                    maxlength="1000"
                >{{ old('decision') === 'approve' ? old('note') : '' }}</textarea>

                <label class="checkbox">
                    <input
                        type="checkbox"
                        name="bank_confirmed"
                        value="1"
                        required
                    >
                    Tôi đã kiểm tra giao dịch nhận tiền, mã giao dịch
                    và số tiền thuộc đơn này.
                </label>

                <button type="submit">
                    Duyệt thanh toán và kích hoạt vé
                </button>
            </form>
        @endif

        <form
            method="POST"
            action="{{ route('admin.payment-reviews.decide', $review->id) }}"
            class="decision"
        >
            @csrf
            <input type="hidden" name="decision" value="reject">

            <label for="reject_note">
                Lý do từ chối / hướng xử lý tiếp theo
            </label>

            <textarea
                id="reject_note"
                name="note"
                required
                minlength="3"
                maxlength="1000"
                placeholder="Ghi rõ lý do và hướng xử lý cho khách."
            >{{ old('decision') === 'reject' ? old('note') : '' }}</textarea>

            <button type="submit" class="danger">
                Từ chối yêu cầu
            </button>
        </form>
    </section>
@endif
@endsection
""",
}

ROOT = Path.cwd()

TARGETS = {
    "controller": "app/Http/Controllers/BookingController.php",
    "routes": "routes/web.php",
    "admin": "resources/views/admin/bookings/index.blade.php",
    "partial": "resources/views/user/partials/ket-qua-hoa-don.blade.php",
}


def once(text, old, new):
    if text.count(old) != 1:
        raise RuntimeError(
            "Vị trí code không khớp bản đã gửi. "
            "Dừng lại, chưa sửa file nào."
        )

    return text.replace(old, new, 1)


def main():
    originals = {}
    texts = {}

    for key, relative in TARGETS.items():
        path = ROOT / relative

        if not path.is_file():
            raise RuntimeError("Không tìm thấy: " + relative)

        originals[relative] = path.read_bytes()

        texts[key] = (
            originals[relative]
            .decode("utf-8-sig")
            .replace("\r\n", "\n")
        )

    for relative in FILES:
        if (ROOT / relative).exists():
            raise RuntimeError(
                "File đã tồn tại, không ghi đè: " + relative
            )

    marker = (
        "            $receiptCheck = $this->receiptCheckReport(\n"
        "                $booking,\n"
        "                $ocr,"
    )

    texts["controller"] = once(
        texts["controller"],
        marker,
        "            $ocr['receipt_path'] = $receiptPath;\n\n" + marker,
    )

    start = texts["controller"].index(
        "    private function receiptCheckReport("
    )

    end = texts["controller"].index(
        "    public function ticket(",
        start,
    )

    helper = texts["controller"][start:end]

    helper = once(
        helper,
        "'booking_id' => $booking->id,",
        (
            "'booking_id' => $booking->id,\n"
            "            'receipt_path' => $ocr['receipt_path'] ?? null,"
        ),
    )

    texts["controller"] = (
        texts["controller"][:start]
        + helper
        + texts["controller"][end:]
    )

    if (
        "payment-reviews.php" in texts["routes"]
        or "?>" in texts["routes"]
    ):
        raise RuntimeError(
            "Cần kiểm tra lại routes/web.php trước khi thêm route."
        )

    texts["routes"] += (
        "\n\nrequire __DIR__ . '/payment-reviews.php';\n"
    )

    texts["partial"] += (
        "\n\n@include('payment-reviews.request-button')\n"
    )

    marker = """href="{{ route('admin.check-ins.index') }}" """

    marker = marker.strip()

    if texts["admin"].count(marker) != 1:
        raise RuntimeError(
            "Không tìm thấy menu Lịch sử check-in "
            "trong trang quản lý vé."
        )

    position = texts["admin"].rfind(
        "<a",
        0,
        texts["admin"].index(marker),
    )

    if position < 0:
        raise RuntimeError("Không tìm thấy vị trí menu admin.")

    menu = '''<a href="{{ route('admin.payment-reviews.index') }}" class="menu-link">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <rect x="3" y="5" width="18" height="14" rx="2"/>
                        <path d="M3 10h18M7 15h5"/>
                    </svg>
                </span>
                Đối soát thanh toán
            </a>
            '''

    texts["admin"] = (
        texts["admin"][:position]
        + menu
        + texts["admin"][position:]
    )

    changes = {
        TARGETS[key]: value
        for key, value in texts.items()
    }

    changes.update(FILES)

    backup = ROOT / (
        "backup_payment_reviews_"
        + datetime.now().strftime("%Y%m%d_%H%M%S_%f")
    )

    for relative in originals:
        target = backup / relative
        target.parent.mkdir(parents=True, exist_ok=True)
        shutil.copy2(ROOT / relative, target)

    created = []

    try:
        for relative, value in changes.items():
            path = ROOT / relative
            path.parent.mkdir(parents=True, exist_ok=True)

            if relative not in originals:
                created.append(path)

            with path.open(
                "w",
                encoding="utf-8",
                newline="",
            ) as handle:
                handle.write(value.replace("\n", "\r\n"))

    except Exception:
        for relative, value in originals.items():
            (ROOT / relative).write_bytes(value)

        for path in created:
            if path.exists():
                path.unlink()

        raise

    print("Đã thêm chức năng đối soát thanh toán.")
    print("Code cũ được sao lưu tại: " + str(backup))
    print("Chạy tiếp: php artisan migrate")
    print("Sau đó: php artisan optimize:clear")


if __name__ == "__main__":
    try:
        main()
    except Exception as error:
        print("DỪNG: " + str(error))
        raise SystemExit(1)