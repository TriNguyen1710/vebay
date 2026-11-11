<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Flight;
use App\Models\FlightSeat;
use App\Models\Payment;
use App\Models\Ticket;
use App\Models\BaggagePackage;
use App\Models\Notification;
use App\Models\User;
use App\Http\Middleware\EnsureBookingFaceVerified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    private const HOLD_MINUTES = 15;

    /*
    |--------------------------------------------------------------------------
    | LẤY PHÍ ĐỔI VÉ TỪ CÀI ĐẶT ADMIN
    |--------------------------------------------------------------------------
    |
    | Bảng: settings
    | Khóa: change_ticket_fee
    |
    | Ví dụ Admin lưu 10000:
    | Phí đổi vé sẽ là 10.000 đồng.
    |
    | Không sử dụng mức phí 100.000 cố định.
    |
    */

    private function getChangeFee(): int
    {
        $value = DB::table('settings')
            ->where('key', 'change_ticket_fee')
            ->value('value');

        if (
            $value === null
            || !is_numeric($value)
            || (float) $value < 0
        ) {
            throw new \RuntimeException(
                'Phí đổi vé chưa được Admin cấu hình hợp lệ.'
            );
        }

        return (int) round((float) $value);
    }

    /*
    |--------------------------------------------------------------------------
    | DANH SÁCH VÉ CỦA TÔI
    |--------------------------------------------------------------------------
    */

    public function myTickets()
    {
        $expiredBookings = Booking::where(
            'user_id',
            auth()->id()
        )
            ->where('payment_status', 'unpaid')
            ->where('booking_status', 'pending')
            ->whereNotNull('expires_at')
            ->where('expires_at', '<=', now())
            ->pluck('id');

        foreach ($expiredBookings as $bookingId) {
            $this->cancelExpiredBookingById($bookingId);
        }

        $bookings = Booking::where(
            'user_id',
            auth()->id()
        )
            ->with([
                'tickets.flight.departureAirport',
                'tickets.flight.arrivalAirport',
                'tickets.flightSeat',
            ])
            ->orderByDesc('created_at')
            ->get();

        return view(
            'user.ve-cua-toi',
            compact('bookings')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SỐ LƯỢNG HÀNH KHÁCH
    |--------------------------------------------------------------------------
    */

    private function passengerCount(): int
    {
        return max(
            1,
            min(
                5,
                (int) session(
                    'flight_search.passenger_count',
                    1
                )
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | KIỂM TRA GÓI HÀNH LÝ
    |--------------------------------------------------------------------------
    |
    | Không mua thêm hành lý:
    | package_id = null, '', hoặc '0'.
    |
    | Có mua thêm:
    | Lấy giá và trọng lượng trực tiếp từ database.
    |
    */

    private function resolveBaggagePackage(array $bag): array
    {
        $packageId = $bag['package_id'] ?? null;

        if (
            $packageId === null
            || $packageId === ''
            || (string) $packageId === '0'
        ) {
            return [
                'package_id' => null,
                'weight' => 0,
                'price' => 0,
            ];
        }

        if (
            !is_numeric($packageId)
            || (int) $packageId <= 0
        ) {
            throw new \RuntimeException(
                'Mã gói hành lý không hợp lệ.'
            );
        }

        $package = BaggagePackage::where(
            'id',
            (int) $packageId
        )
            ->where('type', 'checked')
            ->where('status', 1)
            ->first();

        if (!$package) {
            throw new \RuntimeException(
                'Gói hành lý đã chọn không còn mở bán. Vui lòng chọn lại hành lý.'
            );
        }

        return [
            'package_id' => $package->id,
            'weight' => (int) $package->weight,
            'price' => (float) $package->price,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | TẠO ĐƠN ĐẶT VÉ CHO 1–5 HÀNH KHÁCH
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $count = $this->passengerCount();

        $tripType = session(
            'flight_search.trip_type',
            'one_way'
        );

        $passengers = session(
            'booking.passengers',
            []
        );

        if (!is_array($passengers)) {
            $passengers = [];
        }

        if (
            $count === 1
            && empty($passengers)
            && is_array(session('booking.passenger'))
        ) {
            $passengers = [
                session('booking.passenger')
            ];
        }

        $passengers = array_values($passengers);

        /*
         * Lấy dữ liệu xác thực khuôn mặt.
         */

        $faceImages = session(
            'booking.face_images',
            []
        );

        $faceStatuses = session(
            'booking.face_statuses',
            []
        );

        $faceHashes = session(
            'booking.face_verification_hashes',
            []
        );

        if (!is_array($faceImages)) {
            $faceImages = [];
        }

        if (!is_array($faceStatuses)) {
            $faceStatuses = [];
        }

        if (!is_array($faceHashes)) {
            $faceHashes = [];
        }

        /*
         * Tương thích đặt 1 vé phiên bản cũ.
         */

        if ($count === 1 && empty($faceImages)) {
            $faceImages = [
                session('booking.face_image')
            ];

            $faceStatuses = [
                session('booking.face_status')
            ];

            $faceHashes = [
                session('booking.face_verification_hash')
            ];
        }

        if (count($passengers) !== $count) {
            return redirect()
                ->route('passenger.create')
                ->with(
                    'error',
                    'Thông tin hành khách chưa đầy đủ.'
                );
        }

        /*
         * Kiểm tra xác thực khuôn mặt từng người.
         */

        foreach ($passengers as $index => $passenger) {
            $image = $faceImages[$index] ?? null;
            $savedHash = $faceHashes[$index] ?? null;
            $status = $faceStatuses[$index] ?? null;

            $actualHash = is_string($image)
                ? EnsureBookingFaceVerified::fingerprint(
                    $passenger,
                    $image
                )
                : null;

            if (
                !in_array(
                    $status,
                    ['verified', 'demo'],
                    true
                )
                || !is_string($savedHash)
                || !$actualHash
                || !hash_equals(
                    $savedHash,
                    $actualHash
                )
                || (
                    $status === 'demo'
                    && !app()->environment('local')
                )
            ) {
                return redirect()
                    ->route('face.create')
                    ->with(
                        'error',
                        'Hành khách '
                        . ($index + 1)
                        . ' cần xác thực khuôn mặt lại.'
                    );
            }
        }

        /*
         * Danh sách chuyến bay và ghế được chọn.
         */

        $legs = $tripType === 'round_trip'
            ? [
                [
                    'flight_id' => session(
                        'booking.outbound.flight_id'
                    ),
                    'ids' => session(
                        'booking.outbound.seat_ids',
                        []
                    ),
                    'legacy' => session(
                        'booking.outbound.seat_id'
                    ),
                    'baggage' => session(
                        'baggage.outbound',
                        []
                    ),
                ],
                [
                    'flight_id' => session(
                        'booking.return.flight_id'
                    ),
                    'ids' => session(
                        'booking.return.seat_ids',
                        []
                    ),
                    'legacy' => session(
                        'booking.return.seat_id'
                    ),
                    'baggage' => session(
                        'baggage.return',
                        []
                    ),
                ],
            ]
            : [
                [
                    'flight_id' => session(
                        'booking.flight_id'
                    ),
                    'ids' => session(
                        'booking.seat_ids',
                        []
                    ),
                    'legacy' => session(
                        'booking.seat_id'
                    ),
                    'baggage' => session(
                        'baggage',
                        []
                    ),
                ],
            ];

        /*
         * Mỗi hành khách một ghế trên từng chiều bay.
         */

        foreach ($legs as &$leg) {
            if (!is_array($leg['ids'])) {
                $leg['ids'] = [];
            }

            if (
                empty($leg['ids'])
                && $count === 1
                && !empty($leg['legacy'])
            ) {
                $leg['ids'] = [
                    $leg['legacy']
                ];
            }

            $leg['ids'] = array_map(
                'intval',
                array_values($leg['ids'])
            );

            if (
                empty($leg['flight_id'])
                || count($leg['ids']) !== $count
                || count(array_unique($leg['ids'])) !== $count
            ) {
                return redirect()
                    ->route('flights.search.form')
                    ->with(
                        'error',
                        'Số ghế đã chọn không khớp với số hành khách.'
                    );
            }
        }

        unset($leg);

        /*
         * Lấy hành lý theo từng hành khách.
         */

        $groupBaggage = session(
            'baggage.passengers',
            []
        );

        if (
            $count > 1
            && (
                !is_array($groupBaggage)
                || count($groupBaggage) !== $count
            )
        ) {
            return redirect()
                ->route('baggage.create')
                ->with(
                    'error',
                    'Vui lòng chọn hành lý cho đủ số hành khách.'
                );
        }

        /*
         * Tạo booking và các vé trong transaction.
         */

        try {
            $booking = DB::transaction(
                function () use (
                    $count,
                    $tripType,
                    $passengers,
                    $faceImages,
                    $legs,
                    $groupBaggage
                ) {
                    $flights = [];

                    foreach ($legs as $legIndex => $leg) {
                        $flights[$legIndex] = Flight::where(
                            'id',
                            $leg['flight_id']
                        )
                            ->where('status', 'open')
                            ->first();

                        if (!$flights[$legIndex]) {
                            throw new \RuntimeException(
                                'Chuyến bay không còn mở bán.'
                            );
                        }
                    }

                    /*
                     * Khóa ghế tránh đặt trùng.
                     */

                    $allIds = collect($legs)
                        ->flatMap(
                            fn ($leg) => $leg['ids']
                        )
                        ->unique()
                        ->sort()
                        ->values()
                        ->all();

                    if (
                        count($allIds)
                        !== count($legs) * $count
                    ) {
                        throw new \RuntimeException(
                            'Danh sách ghế có dữ liệu trùng lặp.'
                        );
                    }

                    $lockedSeats = FlightSeat::whereIn(
                        'id',
                        $allIds
                    )
                        ->orderBy('id')
                        ->lockForUpdate()
                        ->get()
                        ->keyBy('id');

                    if (
                        $lockedSeats->count()
                        !== count($allIds)
                    ) {
                        throw new \RuntimeException(
                            'Một số ghế không còn tồn tại.'
                        );
                    }

                    /*
                     * Tính tiền và tạo dữ liệu từng vé.
                     */

                    $ticketRows = [];
                    $totalAmount = 0;

                    foreach ($legs as $legIndex => $leg) {
                        foreach (
                            $leg['ids'] as $personIndex => $seatId
                        ) {
                            $seat = $lockedSeats->get($seatId);

                            if (
                                !$seat
                                || (int) $seat->flight_id
                                    !== (int) $flights[$legIndex]->id
                                || $seat->status !== 'available'
                            ) {
                                throw new \RuntimeException(
                                    'Ghế đã được đặt hoặc không thuộc chuyến bay. Vui lòng chọn lại.'
                                );
                            }

                            /*
                             * Hành lý riêng từng người và từng chiều.
                             */

                            if ($count === 1) {
                                $bag = $leg['baggage'];
                            } elseif ($tripType === 'round_trip') {
                                $bagKey = $legIndex === 0
                                    ? 'outbound'
                                    : 'return';

                                $bag = $groupBaggage[
                                    $personIndex
                                ][$bagKey] ?? null;
                            } else {
                                $bag = $groupBaggage[
                                    $personIndex
                                ]['one_way'] ?? null;
                            }

                            if (!is_array($bag)) {
                                throw new \RuntimeException(
                                    'Thiếu thông tin hành lý của hành khách '
                                    . ($personIndex + 1)
                                );
                            }

                            $resolvedBaggage =
                                $this->resolveBaggagePackage($bag);

                            $baggageWeight = (int) (
                                $resolvedBaggage['weight']
                            );

                            $baggagePrice = (float) (
                                $resolvedBaggage['price']
                            );

                            $ticketPrice =
                                $this->calculateTicketPrice(
                                    $flights[$legIndex],
                                    $seat
                                );

                            $totalAmount +=
                                $ticketPrice + $baggagePrice;

                            $ticketRows[] = [
                                'flight' => $flights[$legIndex],
                                'seat' => $seat,
                                'passenger' =>
                                    $passengers[$personIndex],
                                'face_image' =>
                                    $faceImages[$personIndex],
                                'price' => $ticketPrice,
                                'baggage_weight' =>
                                    $baggageWeight,
                                'baggage_price' =>
                                    $baggagePrice,
                            ];
                        }
                    }

                    /*
                     * Tạo một đơn chung cho tất cả hành khách.
                     */

                    $booking = Booking::create([
                        'user_id' => auth()->id(),
                        'booking_code' =>
                            $this->generateBookingCode(),
                        'total_amount' => $totalAmount,
                        'booking_status' => 'pending',
                        'payment_status' => 'unpaid',
                        'expires_at' => now()->addMinutes(
                            self::HOLD_MINUTES
                        ),
                    ]);

                    /*
                     * Tạo từng vé và đánh dấu ghế đã đặt.
                     */

                    foreach ($ticketRows as $row) {
                        $this->createTicket(
                            $booking,
                            $row['flight'],
                            $row['seat'],
                            $row['passenger'],
                            $row['price'],
                            $row['face_image'],
                            $row['baggage_weight'],
                            $row['baggage_price']
                        );

                        $row['seat']->update([
                            'status' => 'booked',
                        ]);
                    }

                    return $booking;
                },
                3
            );

            /*
             * Xóa dữ liệu đặt vé tạm.
             */

            session()->forget([
                'booking',
                'baggage',
            ]);

            /*
             * Thông báo Admin có đơn đặt vé mới.
             */

            $admins = User::where(
                'role',
                'admin'
            )->get();

            foreach ($admins as $admin) {
                Notification::create([
                    'user_id' => $admin->id,
                    'ticket_id' =>
                        $booking->tickets()->first()?->id,
                    'sender_id' => auth()->id(),
                    'title' => 'Có đơn đặt vé mới',
                    'message' =>
                        'Khách hàng vừa tạo đơn '
                        . $booking->booking_code
                        . ' ('
                        . ($count * count($legs))
                        . ' vé).',
                    'status' => 'unread',
                ]);
            }

            return redirect()
                ->route(
                    'payment.show',
                    $booking->id
                );

        } catch (\Throwable $exception) {
            report($exception);

            return redirect()
                ->route('booking.confirm')
                ->with(
                    'error',
                    $exception->getMessage()
                );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | HIỂN THỊ TRANG THANH TOÁN
    |--------------------------------------------------------------------------
    */

    public function payment(Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        if (
            $booking->payment_status === 'paid'
            && $booking->booking_status === 'confirmed'
        ) {
            return redirect()
                ->route(
                    'ticket.show',
                    $booking->id
                );
        }

        if (
            $booking->payment_status === 'paid'
            && $booking->booking_status === 'pending'
        ) {
            return view(
                'user.thanh-toan',
                compact('booking')
            );
        }

        if ($booking->booking_status === 'cancelled') {
            return redirect()
                ->route('flights.search.form')
                ->with(
                    'error',
                    'Đơn đặt vé này đã bị hủy. Vui lòng đặt vé lại.'
                );
        }

        if ($this->isBookingExpired($booking)) {
            $this->cancelExpiredBookingById(
                $booking->id
            );

            return redirect()
                ->route('flights.search.form')
                ->with(
                    'error',
                    'Thời gian giữ ghế 15 phút đã hết. Ghế đã được giải phóng, vui lòng đặt vé lại.'
                );
        }

        $booking->load([
            'tickets.flight.departureAirport',
            'tickets.flight.arrivalAirport',
            'tickets.flight.aircraft',
            'tickets.flightSeat',
        ]);

        return view(
            'user.thanh-toan',
            compact('booking')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | THANH TOÁN BẰNG ẢNH HÓA ĐƠN OCR
    |--------------------------------------------------------------------------
    |
    | Giữ nguyên chức năng đọc ảnh hóa đơn bằng Python.
    |
    */

    public function pay(
        Request $request,
        Booking $booking
    ) {
        set_time_limit(300);

        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate(
            [
                'payment_receipt' => [
                    'required',
                    'image',
                    'mimes:jpg,jpeg,png',
                    'max:5120',
                ],
            ],
            [
                'payment_receipt.required' =>
                    'Vui lòng tải ảnh hóa đơn chuyển khoản.',
                'payment_receipt.image' =>
                    'Hóa đơn phải là hình ảnh.',
                'payment_receipt.mimes' =>
                    'Hóa đơn phải là ảnh JPG, JPEG hoặc PNG.',
                'payment_receipt.max' =>
                    'Ảnh hóa đơn không được vượt quá 5MB.',
            ]
        );

        if (
            $booking->payment_status === 'paid'
            && $booking->booking_status === 'confirmed'
        ) {
            return redirect()
                ->route(
                    'ticket.show',
                    $booking->id
                );
        }

        if ($booking->booking_status === 'cancelled') {
            return back()->with(
                'error',
                'Đơn đặt vé đã bị hủy.'
            );
        }

        if ($this->isBookingExpired($booking)) {
            $this->cancelExpiredBookingById(
                $booking->id
            );

            return redirect()
                ->route('flights.search.form')
                ->with(
                    'error',
                    'Thời gian giữ ghế 15 phút đã hết. Ghế đã được giải phóng.'
                );
        }

        /*
         * Lưu ảnh hóa đơn.
         */

        $receipt = $request->file('payment_receipt');

        $receiptPath = $receipt->store(
            'payment_receipts',
            'public'
        );

        $absolutePath = storage_path(
            'app/public/' . $receiptPath
        );

        try {
            /*
             * Python và EasyOCR đang dùng trong project.
             */

            $pythonPath =
                'C:\Users\tring\AppData\Local\Programs\Python\Python312\python.exe';

            $result = Process::timeout(300)
                ->env([
                    'PATH' => getenv('PATH'),
                    'SYSTEMROOT' => getenv('SYSTEMROOT'),
                    'WINDIR' => getenv('WINDIR'),
                    'TEMP' => getenv('TEMP'),
                    'TMP' => getenv('TMP'),
                    'PYTHONUTF8' => '1',
                    'PYTHONIOENCODING' => 'utf-8',
                ])
                ->run([
                    $pythonPath,
                    base_path('python/receipt_ocr.py'),
                    $absolutePath,
                    'C:\Users\tring\.EasyOCR\model',
                ]);

            if (!$result->successful()) {
                throw new \Exception(
                    'OCR lỗi: '
                    . trim($result->errorOutput())
                );
            }

            $ocr = json_decode(
                trim($result->output()),
                true
            );

            if (!is_array($ocr)) {
                throw new \Exception(
                    'OCR trả về dữ liệu không hợp lệ: '
                    . $result->output()
                );
            }

            if (empty($ocr['success'])) {
                throw new \Exception(
                    'OCR Python lỗi: '
                    . (
                        $ocr['message']
                        ?? 'Không rõ lỗi.'
                    )
                );
            }

            $ocrText = $ocr['text'] ?? '';

            $normalizedText =
                $ocr['normalized_text'] ?? $ocrText;

            $transactionCode =
                $ocr['transaction_code'] ?? null;

            $amounts = $ocr['amounts'] ?? [];

            $expectedContent =
                'VJ ' . $booking->booking_code;

            /*
             * Chuẩn hóa nội dung chuyển khoản.
             */

            $normalizedExpectedContent = strtoupper(
                preg_replace(
                    '/[^A-Za-z0-9]/',
                    '',
                    $expectedContent
                )
            );

            $normalizedReceipt = strtoupper(
                preg_replace(
                    '/[^A-Za-z0-9]/',
                    '',
                    $normalizedText
                )
            );

            /*
             * Kiểm tra đúng nội dung chuyển khoản.
             */

            $hasCorrectContent = str_contains(
                $normalizedReceipt,
                $normalizedExpectedContent
            );

            if (!$hasCorrectContent) {
                $ocrConfusionMap = [
                    'O' => '0',
                    'S' => '5',
                ];

                $canonicalExpectedContent = strtr(
                    $normalizedExpectedContent,
                    $ocrConfusionMap
                );

                $canonicalReceipt = strtr(
                    $normalizedReceipt,
                    $ocrConfusionMap
                );

                $hasCorrectContent = str_contains(
                    $canonicalReceipt,
                    $canonicalExpectedContent
                );
            }

            if (!$hasCorrectContent) {
                $receiptLength = strlen(
                    $normalizedReceipt
                );

                $expectedLength = strlen(
                    $normalizedExpectedContent
                );

                for (
                    $i = 0;
                    $i <= $receiptLength - $expectedLength;
                    $i++
                ) {
                    $part = substr(
                        $normalizedReceipt,
                        $i,
                        $expectedLength
                    );

                    if (
                        levenshtein(
                            $normalizedExpectedContent,
                            $part
                        ) <= 1
                    ) {
                        $hasCorrectContent = true;
                        break;
                    }
                }
            }

            /*
             * Kiểm tra số tiền bằng VNĐ.
             */

            $expectedAmount = (int) (
                $booking->total_amount
            );

            $hasCorrectAmount = false;

            foreach ($amounts as $amount) {
                if ((int) $amount === $expectedAmount) {
                    $hasCorrectAmount = true;
                    break;
                }
            }

            $ocr['receipt_path'] = $receiptPath;

            $receiptCheck = $this->receiptCheckReport(
                $booking,
                $ocr,
                $hasCorrectContent,
                $hasCorrectAmount,
                $transactionCode
                    && !Payment::where(
                        'receipt_transaction_code',
                        $transactionCode
                    )->exists()
            );

            /*
             * Kiểm tra mã giao dịch.
             */

            if (!$transactionCode) {
                return back()
                    ->with(
                        'error',
                        'Không đọc được mã giao dịch trên hóa đơn. Vui lòng sử dụng ảnh hóa đơn rõ hơn.'
                    )
                    ->with(
                        'receipt_check',
                        $receiptCheck
                    );
            }

            /*
             * Không cho phép dùng mã giao dịch trùng.
             */

            if (
                Payment::where(
                    'receipt_transaction_code',
                    $transactionCode
                )->exists()
            ) {
                return back()
                    ->with(
                        'error',
                        'Mã giao dịch này đã được sử dụng cho một thanh toán khác.'
                    )
                    ->with(
                        'receipt_check',
                        $receiptCheck
                    );
            }

            if (!$hasCorrectContent) {
                return back()
                    ->with(
                        'error',
                        'Hóa đơn không hợp lệ. Nội dung chuyển khoản không đúng.'
                    )
                    ->with(
                        'receipt_check',
                        $receiptCheck
                    );
            }

            if (!$hasCorrectAmount) {
                return back()
                    ->with(
                        'error',
                        'Hóa đơn không hợp lệ. Số tiền chuyển khoản không đúng.'
                    )
                    ->with(
                        'receipt_check',
                        $receiptCheck
                    );
            }

            /*
             * Ghi nhận thanh toán trong transaction.
             */

            DB::transaction(
                function () use (
                    $booking,
                    $receiptPath,
                    $transactionCode,
                    $ocrText,
                    $expectedAmount,
                    $expectedContent
                ) {
                    $lockedBooking = Booking::where(
                        'id',
                        $booking->id
                    )
                        ->lockForUpdate()
                        ->firstOrFail();

                    if (
                        $lockedBooking->payment_status
                        === 'paid'
                    ) {
                        return;
                    }

                    if (
                        $lockedBooking->booking_status
                        === 'cancelled'
                    ) {
                        throw new \Exception(
                            'Đơn đặt vé đã bị hủy.'
                        );
                    }

                    if (
                        $this->isBookingExpired(
                            $lockedBooking
                        )
                    ) {
                        throw new \Exception(
                            'Thời gian giữ ghế 15 phút đã hết.'
                        );
                    }

                    if (
                        Payment::where(
                            'receipt_transaction_code',
                            $transactionCode
                        )
                            ->lockForUpdate()
                            ->exists()
                    ) {
                        throw new \Exception(
                            'Mã giao dịch này đã được sử dụng.'
                        );
                    }

                    /*
                     * Đánh dấu đơn đã thanh toán.
                     */

                    $lockedBooking->update([
                        'payment_status' => 'paid',
                        'booking_status' => 'confirmed',
                        'expires_at' => null,
                    ]);

                    /*
                     * Kích hoạt tất cả vé.
                     */

                    Ticket::where(
                        'booking_id',
                        $lockedBooking->id
                    )->update([
                        'ticket_status' => 'active',
                    ]);

                    /*
                     * Lưu thông tin giao dịch.
                     */

                    Payment::create([
                        'booking_id' =>
                            $lockedBooking->id,
                        'payment_code' =>
                            'PAY' . Str::upper(
                                Str::random(10)
                            ),
                        'amount' => $expectedAmount,
                        'payment_method' =>
                            'bank_transfer',
                        'payment_status' => 'paid',
                        'receipt_image' => $receiptPath,
                        'receipt_transaction_code' =>
                            $transactionCode,
                        'receipt_content' =>
                            $expectedContent,
                        'receipt_amount' =>
                            $expectedAmount,
                        'ocr_text' => $ocrText,
                        'paid_at' => now(),
                    ]);

                    /*
                     * Thông báo Admin.
                     */

                    $admins = User::where(
                        'role',
                        'admin'
                    )->get();

                    foreach ($admins as $admin) {
                        Notification::create([
                            'user_id' => $admin->id,
                            'ticket_id' =>
                                $lockedBooking
                                    ->tickets()
                                    ->first()?->id,
                            'sender_id' => auth()->id(),
                            'title' =>
                                'Thanh toán thành công',
                            'message' =>
                                'Đơn '
                                . $lockedBooking->booking_code
                                . ' đã thanh toán thành công '
                                . number_format(
                                    $expectedAmount,
                                    0,
                                    ',',
                                    '.'
                                )
                                . 'đ.',
                            'status' => 'unread',
                        ]);
                    }
                }
            );

            return redirect()
                ->route(
                    'ticket.show',
                    $booking->id
                )
                ->with(
                    'success',
                    'Thanh toán thành công. Vé đã có hiệu lực.'
                );

        } catch (\Throwable $e) {
            return redirect()
                ->route(
                    'payment.show',
                    $booking->id
                )
                ->with(
                    'error',
                    $e->getMessage()
                )
                ->with(
                    'receipt_check',
                    isset($receiptCheck)
                        ? $receiptCheck
                        : [
                            'booking_id' => $booking->id,
                            'expected_content' =>
                                'VJ ' . $booking->booking_code,
                            'expected_amount' =>
                                (int) $booking->total_amount,
                            'read_content' => null,
                            'amounts' => [],
                            'content_matches' => false,
                            'amount_matches' => false,
                            'transaction_code' => null,
                            'transaction_unused' => false,
                            'verified' => false,
                            'ocr_text' => '',
                        ]
                );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | TẠO BÁO CÁO KIỂM TRA OCR
    |--------------------------------------------------------------------------
    */

    private function receiptCheckReport(
        Booking $booking,
        array $ocr,
        bool $contentMatches,
        bool $amountMatches,
        bool $transactionUnused,
        bool $verified = false
    ): array {
        $expectedContent = $ocr[
            'expected_content'
        ] ?? (
            'VJ ' . $booking->booking_code
        );

        $expectedAmount = (int) (
            $ocr['expected_amount']
            ?? $booking->total_amount
        );

        $text = (string) (
            $ocr['text'] ?? ''
        );

        $normalized = strtoupper(
            preg_replace(
                '/[^A-Za-z0-9]/',
                '',
                Str::ascii($text)
            )
        );

        $expected = strtoupper(
            preg_replace(
                '/[^A-Za-z0-9]/',
                '',
                $expectedContent
            )
        );

        $readContent = null;
        $length = strlen($expected);

        $map = [
            'O' => '0',
            'S' => '5',
        ];

        if (
            $length > 0
            && $contentMatches
        ) {
            for (
                $i = 0;
                $i <= strlen($normalized) - $length;
                $i++
            ) {
                $part = substr(
                    $normalized,
                    $i,
                    $length
                );

                if (
                    $part === $expected
                    || strtr($part, $map)
                        === strtr($expected, $map)
                    || levenshtein(
                        $expected,
                        $part
                    ) <= 1
                ) {
                    $readContent = $part;
                    break;
                }
            }
        }

        /*
         * Trích xuất nội dung chuyển khoản từ OCR.
         */

        if ($readContent === null) {
            $lines = preg_split(
                '/\R/u',
                $text
            ) ?: [];

            foreach ($lines as $index => $line) {
                $plain = strtoupper(
                    trim(
                        Str::ascii($line)
                    )
                );

                if (
                    preg_match(
                        '/^NOI\s+DUNG(?:\s+CHUYEN\s+(?:KHOAN|TIEN))?\s*[:\-]?\s*(.*)$/',
                        $plain,
                        $match
                    )
                ) {
                    $candidate = trim($match[1]);

                    if ($candidate === '') {
                        for (
                            $next = $index + 1;
                            $next < count($lines);
                            $next++
                        ) {
                            if (
                                trim($lines[$next]) !== ''
                            ) {
                                $candidate = trim(
                                    $lines[$next]
                                );
                                break;
                            }
                        }
                    }

                    $readContent = $candidate !== ''
                        ? $candidate
                        : null;

                    break;
                }
            }
        }

        $amounts = array_values(
            array_unique(
                array_map(
                    'intval',
                    array_filter(
                        $ocr['amounts'] ?? [],
                        'is_numeric'
                    )
                )
            )
        );

        return [
            'booking_id' => $booking->id,
            'receipt_path' =>
                $ocr['receipt_path'] ?? null,
            'expected_content' =>
                $expectedContent,
            'expected_amount' =>
                $expectedAmount,
            'read_content' => $readContent,
            'amounts' => $amounts,
            'content_matches' => $contentMatches,
            'amount_matches' => $amountMatches,
            'transaction_code' =>
                $ocr['transaction_code'] ?? null,
            'transaction_unused' =>
                $transactionUnused,
            'verified' => $verified,
            'ocr_text' => $text,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | XEM VÉ ĐIỆN TỬ
    |--------------------------------------------------------------------------
    */

    public function ticket(Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        if (
            $booking->payment_status !== 'paid'
            || $booking->booking_status !== 'confirmed'
        ) {
            if ($this->isBookingExpired($booking)) {
                $this->cancelExpiredBookingById(
                    $booking->id
                );

                return redirect()
                    ->route('flights.search.form')
                    ->with(
                        'error',
                        'Đơn đặt vé đã hết thời gian giữ ghế. Vui lòng đặt vé lại.'
                    );
            }

            return redirect()
                ->route(
                    'payment.show',
                    $booking->id
                )
                ->with(
                    'error',
                    'Vui lòng thanh toán trước khi xem vé điện tử.'
                );
        }

        $booking->load([
            'tickets.flight.departureAirport',
            'tickets.flight.arrivalAirport',
            'tickets.flight.aircraft',
            'tickets.flightSeat',
        ]);

        /*
         * Kết quả đọc hóa đơn đã lưu.
         */

        $receiptCheck = null;

        $payment = Payment::where(
            'booking_id',
            $booking->id
        )
            ->where('payment_status', 'paid')
            ->where('payment_method', 'bank_transfer')
            ->orderByDesc('id')
            ->first();

        if (
            $payment
            && $payment->ocr_text
            && $payment->receipt_content
            && $payment->receipt_amount !== null
            && $payment->receipt_transaction_code
        ) {
            $receiptCheck = $this->receiptCheckReport(
                $booking,
                [
                    'text' => $payment->ocr_text,
                    'amounts' => [
                        (int) $payment->receipt_amount
                    ],
                    'transaction_code' =>
                        $payment->receipt_transaction_code,
                    'expected_content' =>
                        $payment->receipt_content,
                    'expected_amount' =>
                        (int) $payment->amount,
                ],
                true,
                (int) $payment->receipt_amount
                    === (int) $payment->amount,
                true,
                true
            );
        }

        return view(
            'user.ve-dien-tu',
            compact(
                'booking',
                'receiptCheck'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | CHỌN CHUYẾN BAY MỚI ĐỂ ĐỔI VÉ
    |--------------------------------------------------------------------------
    */

    public function changeFlight(Ticket $ticket)
    {
        $this->authorizeTicketChange($ticket);

        $ticket->load([
            'booking',
            'flight.departureAirport',
            'flight.arrivalAirport',
            'flightSeat',
        ]);

        $flights = Flight::where(
            'departure_airport_id',
            $ticket->flight->departure_airport_id
        )
            ->where(
                'arrival_airport_id',
                $ticket->flight->arrival_airport_id
            )
            ->where('status', 'open')
            ->where('id', '!=', $ticket->flight_id)
            ->whereDate(
                'flight_date',
                '>=',
                now()->toDateString()
            )
            ->whereHas(
                'flightSeats',
                function ($query) {
                    $query->where(
                        'status',
                        'available'
                    );
                }
            )
            ->with([
                'departureAirport',
                'arrivalAirport',
                'aircraft',
            ])
            ->orderBy('flight_date')
            ->orderBy('departure_time')
            ->get();

        return view(
            'user.doi-chuyen-bay',
            compact(
                'ticket',
                'flights'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | CHỌN GHẾ CHUYẾN BAY MỚI
    |--------------------------------------------------------------------------
    */

    public function changeSeat(
        Ticket $ticket,
        Flight $flight
    ) {
        $this->authorizeTicketChange($ticket);

        if (
            $flight->departure_airport_id
                !== $ticket->flight->departure_airport_id
            || $flight->arrival_airport_id
                !== $ticket->flight->arrival_airport_id
            || $flight->status !== 'open'
            || $flight->id === $ticket->flight_id
            || $flight->flight_date->isBefore(
                now()->startOfDay()
            )
        ) {
            return redirect()
                ->route(
                    'ticket.change.flight',
                    $ticket->id
                )
                ->with(
                    'error',
                    'Chuyến bay mới không hợp lệ.'
                );
        }

        $ticket->load([
            'booking',
            'flight.departureAirport',
            'flight.arrivalAirport',
            'flightSeat',
        ]);

        $flight->load([
            'departureAirport',
            'arrivalAirport',
            'aircraft',
            'flightSeats' => function ($query) {
                $query
                    ->where('status', 'available')
                    ->orderBy('seat_number');
            },
        ]);

        return view(
            'user.doi-chon-ghe',
            compact(
                'ticket',
                'flight'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | XÁC NHẬN ĐỔI VÉ
    |--------------------------------------------------------------------------
    |
    | Đã sửa:
    | Lấy phí đổi vé từ cài đặt của Admin.
    |
    */

    public function changeConfirm(
        Request $request,
        Ticket $ticket
    ) {
        $this->authorizeTicketChange($ticket);

        $validated = $request->validate(
            [
                'flight_id' => [
                    'required',
                    'integer',
                    'exists:flights,id',
                ],
                'seat_id' => [
                    'required',
                    'integer',
                    'exists:flight_seats,id',
                ],
            ],
            [
                'flight_id.required' =>
                    'Vui lòng chọn chuyến bay mới.',
                'seat_id.required' =>
                    'Vui lòng chọn ghế mới.',
            ]
        );

        $flight = Flight::where(
            'id',
            $validated['flight_id']
        )
            ->where('status', 'open')
            ->firstOrFail();

        $seat = FlightSeat::where(
            'id',
            $validated['seat_id']
        )
            ->where('flight_id', $flight->id)
            ->where('status', 'available')
            ->first();

        if (!$seat) {
            return back()->with(
                'error',
                'Ghế vừa chọn không còn trống. Vui lòng chọn ghế khác.'
            );
        }

        if (
            $flight->departure_airport_id
                !== $ticket->flight->departure_airport_id
            || $flight->arrival_airport_id
                !== $ticket->flight->arrival_airport_id
            || $flight->id === $ticket->flight_id
        ) {
            return redirect()
                ->route(
                    'ticket.change.flight',
                    $ticket->id
                )
                ->with(
                    'error',
                    'Chuyến bay mới không hợp lệ.'
                );
        }

        $newPrice = $this->calculateTicketPrice(
            $flight,
            $seat
        );

        $fareDifference = max(
            0,
            $newPrice - (float) $ticket->price
        );

        /*
         * SỬA: Lấy phí đổi vé Admin đã thiết lập.
         */

        try {
            $changeFee = $this->getChangeFee();
        } catch (\RuntimeException $e) {
            return back()->with(
                'error',
                $e->getMessage()
            );
        }

        $amountToPay =
            $changeFee + $fareDifference;

        /*
         * Lưu phí chính xác vào session.
         */

        session([
            'ticket_change' => [
                'ticket_id' => $ticket->id,
                'flight_id' => $flight->id,
                'seat_id' => $seat->id,
                'old_price' => (float) $ticket->price,
                'new_price' => $newPrice,
                'fare_difference' => $fareDifference,
                'change_fee' => $changeFee,
                'amount_to_pay' => $amountToPay,
            ],
        ]);

        $ticket->load([
            'booking',
            'flight.departureAirport',
            'flight.arrivalAirport',
            'flightSeat',
        ]);

        $flight->load([
            'departureAirport',
            'arrivalAirport',
        ]);

        return view(
            'user.doi-thanh-toan',
            compact(
                'ticket',
                'flight',
                'seat',
                'newPrice',
                'fareDifference',
                'amountToPay'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | THANH TOÁN ĐỔI CHUYẾN BAY
    |--------------------------------------------------------------------------
    |
    | Đã sửa:
    | Đọc lại phí đổi vé Admin để tránh sử dụng
    | mức giá cũ trong session.
    |
    | Giữ nguyên quy trình xác nhận đổi vé hiện tại.
    |
    */

    public function changePay(
        Request $request,
        Ticket $ticket
    ) {
        $this->authorizeTicketChange($ticket);

        $change = session('ticket_change');

        if (
            !$change
            || (int) $change['ticket_id'] !== $ticket->id
        ) {
            return redirect()
                ->route(
                    'ticket.change.flight',
                    $ticket->id
                )
                ->with(
                    'error',
                    'Phiên đổi vé không còn hợp lệ. Vui lòng chọn lại chuyến bay.'
                );
        }

        try {
            DB::transaction(
                function () use ($ticket, $change) {
                    /*
                     * Khóa vé và đơn đặt vé.
                     */

                    $lockedTicket = Ticket::where(
                        'id',
                        $ticket->id
                    )
                        ->lockForUpdate()
                        ->firstOrFail();

                    $booking = Booking::where(
                        'id',
                        $lockedTicket->booking_id
                    )
                        ->lockForUpdate()
                        ->firstOrFail();

                    if (
                        $booking->user_id !== auth()->id()
                        || $booking->payment_status !== 'paid'
                        || $lockedTicket->ticket_status !== 'active'
                    ) {
                        throw new \Exception(
                            'Vé không còn đủ điều kiện để đổi chuyến.'
                        );
                    }

                    /*
                     * Chuyến bay mới.
                     */

                    $newFlight = Flight::where(
                        'id',
                        $change['flight_id']
                    )
                        ->where('status', 'open')
                        ->first();

                    if (!$newFlight) {
                        throw new \Exception(
                            'Chuyến bay mới không còn mở bán.'
                        );
                    }

                    /*
                     * Ghế mới.
                     */

                    $newSeat = FlightSeat::where(
                        'id',
                        $change['seat_id']
                    )
                        ->where('flight_id', $newFlight->id)
                        ->lockForUpdate()
                        ->first();

                    if (
                        !$newSeat
                        || $newSeat->status !== 'available'
                    ) {
                        throw new \Exception(
                            'Ghế mới đã được người khác đặt. Vui lòng chọn ghế khác.'
                        );
                    }

                    /*
                     * Ghế cũ.
                     */

                    $oldSeat = FlightSeat::where(
                        'id',
                        $lockedTicket->flight_seat_id
                    )
                        ->lockForUpdate()
                        ->first();

                    /*
                     * Tính lại giá vé.
                     */

                    $newPrice = $this->calculateTicketPrice(
                        $newFlight,
                        $newSeat
                    );

                    $fareDifference = max(
                        0,
                        $newPrice
                            - (float) $lockedTicket->price
                    );

                    /*
                     * SỬA: Không dùng CHANGE_FEE = 100000.
                     * Lấy phí mới nhất từ cài đặt Admin.
                     */

                    $changeFee = $this->getChangeFee();

                    $amountToPay =
                        $changeFee + $fareDifference;

                    /*
                     * Nếu giá thay đổi so với lúc khách
                     * xem QR, yêu cầu chọn lại.
                     */

                    if (
                        (float) $amountToPay
                        !== (float) $change['amount_to_pay']
                    ) {
                        throw new \Exception(
                            'Giá vé hoặc phí đổi vé đã thay đổi. Vui lòng thực hiện đổi vé lại.'
                        );
                    }

                    /*
                     * Đánh dấu ghế mới đã đặt.
                     */

                    $newSeat->update([
                        'status' => 'booked',
                    ]);

                    $oldPrice = (float) (
                        $lockedTicket->price
                    );

                    /*
                     * Chỉ cập nhật đúng vé đang đổi.
                     */

                    $lockedTicket->update([
                        'flight_id' => $newFlight->id,
                        'flight_seat_id' => $newSeat->id,
                        'seat_class' => $newSeat->seat_class,
                        'price' => $newPrice,
                    ]);

                    /*
                     * Giải phóng ghế cũ.
                     */

                    if ($oldSeat) {
                        $oldSeat->update([
                            'status' => 'available',
                        ]);
                    }

                    /*
                     * Cập nhật tổng tiền trong đơn.
                     * Sử dụng phí đổi vé thực tế từ Admin.
                     */

                    $booking->update([
                        'total_amount' => max(
                            0,
                            (float) $booking->total_amount
                                - $oldPrice
                                + $newPrice
                                + $changeFee
                        ),
                    ]);
                }
            );

        } catch (\Exception $e) {
            return redirect()
                ->route(
                    'ticket.change.flight',
                    $ticket->id
                )
                ->with(
                    'error',
                    $e->getMessage()
                );
        }

        /*
         * Xóa session đổi vé.
         */

        session()->forget('ticket_change');

        $ticket->refresh();

        /*
         * Thông báo Admin.
         */

        $admins = User::where(
            'role',
            'admin'
        )->get();

        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'ticket_id' => $ticket->id,
                'sender_id' => auth()->id(),
                'title' => 'Khách hàng đã đổi vé',
                'message' =>
                    'Vé '
                    . $ticket->ticket_code
                    . ' của đơn '
                    . $ticket->booking->booking_code
                    . ' đã được đổi chuyến thành công.',
                'status' => 'unread',
            ]);
        }

        return redirect()
            ->route('tickets.mine')
            ->with(
                'success',
                'Đổi chuyến bay thành công. Ghế cũ đã được giải phóng.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | HIỂN THỊ TRANG HỦY VÉ
    |--------------------------------------------------------------------------
    |
    | Giữ nguyên cơ chế hủy trực tiếp.
    | Admin chỉ xác nhận hoàn tiền.
    |
    */

    public function cancelTicket(Ticket $ticket)
    {
        $ticket->load([
            'booking',
            'flight.departureAirport',
            'flight.arrivalAirport',
            'flightSeat',
        ]);

        if (
            $ticket->booking->user_id !== auth()->id()
        ) {
            abort(403);
        }

        if (
            $ticket->booking->payment_status !== 'paid'
            || $ticket->booking->booking_status !== 'confirmed'
            || $ticket->ticket_status !== 'active'
        ) {
            return redirect()
                ->route('tickets.mine')
                ->with(
                    'error',
                    'Vé này không đủ điều kiện để hủy.'
                );
        }

        if (
            $ticket->flight->flight_date->isBefore(
                now()->startOfDay()
            )
        ) {
            return redirect()
                ->route('tickets.mine')
                ->with(
                    'error',
                    'Không thể hủy vé của chuyến bay đã qua ngày khởi hành.'
                );
        }

        /*
         * Tỷ lệ hoàn tiền hiện tại của controller.
         * Phần này giữ theo file gốc bạn gửi.
         */

        $refundPercentage = 60;

        $refundAmount = round(
            (float) $ticket->price
            * $refundPercentage
            / 100
        );

        return view(
            'user.huy-ve',
            compact(
                'ticket',
                'refundPercentage',
                'refundAmount'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | GỬI YÊU CẦU HỦY VÉ VÀ HOÀN TIỀN
    |--------------------------------------------------------------------------
    */

    public function submitCancellation(
        Request $request,
        Ticket $ticket
    ) {
        $validated = $request->validate(
            [
                'refund_bank_name' => [
                    'required',
                    'string',
                    'max:100',
                ],
                'refund_account_number' => [
                    'required',
                    'string',
                    'max:50',
                ],
                'refund_account_name' => [
                    'required',
                    'string',
                    'max:100',
                ],
            ],
            [
                'refund_bank_name.required' =>
                    'Vui lòng nhập tên ngân hàng.',
                'refund_account_number.required' =>
                    'Vui lòng nhập số tài khoản.',
                'refund_account_name.required' =>
                    'Vui lòng nhập tên chủ tài khoản.',
            ]
        );

        try {
            DB::transaction(
                function () use (
                    $ticket,
                    $validated
                ) {
                    /*
                     * Khóa vé và booking.
                     */

                    $lockedTicket = Ticket::where(
                        'id',
                        $ticket->id
                    )
                        ->lockForUpdate()
                        ->firstOrFail();

                    $booking = Booking::where(
                        'id',
                        $lockedTicket->booking_id
                    )
                        ->lockForUpdate()
                        ->firstOrFail();

                    if (
                        $booking->user_id !== auth()->id()
                    ) {
                        abort(403);
                    }

                    if (
                        $booking->payment_status !== 'paid'
                        || $booking->booking_status !== 'confirmed'
                        || $lockedTicket->ticket_status !== 'active'
                    ) {
                        throw new \Exception(
                            'Vé này không còn đủ điều kiện để hủy.'
                        );
                    }

                    $flight = Flight::where(
                        'id',
                        $lockedTicket->flight_id
                    )->firstOrFail();

                    if (
                        $flight->flight_date->isBefore(
                            now()->startOfDay()
                        )
                    ) {
                        throw new \Exception(
                            'Không thể hủy vé của chuyến bay đã qua ngày khởi hành.'
                        );
                    }

                    /*
                     * Giữ nguyên cách tính hoàn tiền cũ.
                     */

                    $refundAmount = round(
                        (float) $lockedTicket->price * 0.6
                    );

                    /*
                     * Giải phóng ghế.
                     */

                    FlightSeat::where(
                        'id',
                        $lockedTicket->flight_seat_id
                    )
                        ->lockForUpdate()
                        ->update([
                            'status' => 'available',
                        ]);

                    /*
                     * Đánh dấu vé đã hủy.
                     */

                    Ticket::where(
                        'id',
                        $lockedTicket->id
                    )->update([
                        'ticket_status' => 'cancelled',
                        'refund_amount' => $refundAmount,
                        'refund_status' =>
                            'waiting_confirmation',
                        'refund_bank_name' =>
                            $validated['refund_bank_name'],
                        'refund_account_number' =>
                            $validated['refund_account_number'],
                        'refund_account_name' =>
                            $validated['refund_account_name'],
                    ]);

                    /*
                     * Nếu toàn bộ vé đã hủy thì hủy đơn.
                     */

                    $remainingActiveTickets = Ticket::where(
                        'booking_id',
                        $booking->id
                    )
                        ->where('ticket_status', 'active')
                        ->count();

                    if ($remainingActiveTickets === 0) {
                        $booking->update([
                            'booking_status' => 'cancelled',
                        ]);
                    }

                    /*
                     * Thông báo Admin xử lý hoàn tiền.
                     */

                    $admins = User::where(
                        'role',
                        'admin'
                    )->get();

                    foreach ($admins as $admin) {
                        Notification::create([
                            'user_id' => $admin->id,
                            'ticket_id' => $lockedTicket->id,
                            'sender_id' => auth()->id(),
                            'title' =>
                                'Có yêu cầu hoàn tiền mới',
                            'message' =>
                                'Khách hàng đã hủy vé '
                                . $lockedTicket->ticket_code
                                . ' của đơn '
                                . $booking->booking_code
                                . ' và đang chờ xác nhận hoàn tiền.',
                            'status' => 'unread',
                        ]);
                    }
                }
            );

        } catch (\Exception $e) {
            return redirect()
                ->route('tickets.mine')
                ->with(
                    'error',
                    $e->getMessage()
                );
        }

        return redirect()
            ->route('tickets.mine')
            ->with(
                'success',
                'Hủy vé thành công. Yêu cầu hoàn tiền đã được gửi và đang chờ Admin xác nhận.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | KIỂM TRA ĐIỀU KIỆN ĐỔI VÉ
    |--------------------------------------------------------------------------
    */

    private function authorizeTicketChange(
        Ticket $ticket
    ): void {
        $ticket->loadMissing([
            'booking',
            'flight',
        ]);

        if (
            $ticket->booking->user_id !== auth()->id()
        ) {
            abort(403);
        }

        if (
            $ticket->booking->payment_status !== 'paid'
            || $ticket->booking->booking_status !== 'confirmed'
            || $ticket->ticket_status !== 'active'
        ) {
            abort(
                403,
                'Vé này không đủ điều kiện để đổi chuyến.'
            );
        }

        if (
            $ticket->flight->flight_date->isBefore(
                now()->startOfDay()
            )
        ) {
            abort(
                403,
                'Không thể đổi chuyến bay đã qua ngày khởi hành.'
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | KIỂM TRA ĐƠN ĐÃ HẾT HẠN
    |--------------------------------------------------------------------------
    */

    private function isBookingExpired(
        Booking $booking
    ): bool {
        if ($booking->payment_status === 'paid') {
            return false;
        }

        if (!$booking->expires_at) {
            return false;
        }

        return $booking->expires_at->isPast();
    }

    /*
    |--------------------------------------------------------------------------
    | TỰ ĐỘNG HỦY ĐƠN SAU 15 PHÚT
    |--------------------------------------------------------------------------
    */

    private function cancelExpiredBookingById(
        int $bookingId
    ): void {
        DB::transaction(
            function () use ($bookingId) {
                $booking = Booking::where(
                    'id',
                    $bookingId
                )
                    ->lockForUpdate()
                    ->first();

                if (
                    !$booking
                    || $booking->payment_status === 'paid'
                    || $booking->booking_status !== 'pending'
                ) {
                    return;
                }

                if (!$this->isBookingExpired($booking)) {
                    return;
                }

                /*
                 * Lấy tất cả vé thuộc đơn.
                 */

                $tickets = Ticket::where(
                    'booking_id',
                    $booking->id
                )
                    ->lockForUpdate()
                    ->get();

                /*
                 * Giải phóng ghế.
                 */

                foreach ($tickets as $ticket) {
                    FlightSeat::where(
                        'id',
                        $ticket->flight_seat_id
                    )
                        ->lockForUpdate()
                        ->update([
                            'status' => 'available',
                        ]);
                }

                /*
                 * Hủy toàn bộ vé.
                 */

                Ticket::where(
                    'booking_id',
                    $booking->id
                )->update([
                    'ticket_status' => 'cancelled',
                ]);

                $booking->update([
                    'booking_status' => 'cancelled',
                ]);

                /*
                 * Gửi thông báo Admin.
                 */

                $admins = User::where(
                    'role',
                    'admin'
                )->get();

                foreach ($admins as $admin) {
                    Notification::create([
                        'user_id' => $admin->id,
                        'ticket_id' =>
                            $tickets->first()?->id,
                        'sender_id' => $booking->user_id,
                        'title' => 'Đơn đã tự động hủy',
                        'message' =>
                            'Đơn '
                            . $booking->booking_code
                            . ' đã bị hủy do quá 15 phút chưa thanh toán.',
                        'status' => 'unread',
                    ]);
                }
            }
        );
    }

    /*
    |--------------------------------------------------------------------------
    | TÍNH GIÁ VÉ PHỔ THÔNG / VIP
    |--------------------------------------------------------------------------
    */

    private function calculateTicketPrice(
        Flight $flight,
        FlightSeat $seat
    ) {
        if ($seat->seat_class === 'vip') {
            return (float) $flight->price
                + (float) $flight->vip_surcharge;
        }

        return (float) $flight->price;
    }

    /*
    |--------------------------------------------------------------------------
    | TẠO VÉ CHO TỪNG HÀNH KHÁCH
    |--------------------------------------------------------------------------
    */

    private function createTicket(
        Booking $booking,
        Flight $flight,
        FlightSeat $seat,
        array $passenger,
        float $ticketPrice,
        string $faceImage,
        int $baggageWeight = 0,
        float $baggagePrice = 0
    ) {
        return Ticket::create([
            'booking_id' => $booking->id,
            'flight_id' => $flight->id,
            'flight_seat_id' => $seat->id,
            'seat_class' => $seat->seat_class,
            'ticket_code' =>
                $this->generateTicketCode(),
            'passenger_name' =>
                $passenger['full_name'],
            'date_of_birth' =>
                $passenger['date_of_birth'],
            'gender' => $passenger['gender'],
            'identity_number' =>
                $passenger['identity_number'],
            'phone' => $passenger['phone'],
            'email' => $passenger['email'],
            'price' => $ticketPrice,
            'baggage_weight' => $baggageWeight,
            'baggage_price' => $baggagePrice,
            'ticket_status' => 'pending',
            'face_image' => $faceImage,
            'cccd_image' =>
                $passenger['cccd_image'],
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | SINH MÃ ĐẶT VÉ
    |--------------------------------------------------------------------------
    */

    private function generateBookingCode()
    {
        do {
            $code =
                'BK' . Str::upper(Str::random(8));
        } while (
            Booking::where(
                'booking_code',
                $code
            )->exists()
        );

        return $code;
    }

    /*
    |--------------------------------------------------------------------------
    | SINH MÃ VÉ
    |--------------------------------------------------------------------------
    */

    private function generateTicketCode()
    {
        do {
            $code =
                'VE' . Str::upper(Str::random(10));
        } while (
            Ticket::where(
                'ticket_code',
                $code
            )->exists()
        );

        return $code;
    }
}
