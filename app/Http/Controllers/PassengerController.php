<?php

namespace App\Http\Controllers;

use App\Http\Middleware\EnsureBookingFaceVerified;
use App\Models\Flight;
use App\Models\FlightSeat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PassengerController extends Controller
{
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
    | DANH SÁCH HÀNH KHÁCH TRONG SESSION
    |--------------------------------------------------------------------------
    */

    private function passengers(): array
    {
        $count = $this->passengerCount();

        $passengers = session(
            'booking.passengers',
            []
        );

        if (!is_array($passengers)) {
            $passengers = [];
        }

        /*
         * Giữ tương thích với trường hợp
         * đặt một vé của hệ thống cũ.
         */
        if (
            $count === 1
            && empty($passengers)
        ) {
            $oldPassenger = session(
                'booking.passenger'
            );

            if (is_array($oldPassenger)) {
                $passengers = [
                    $oldPassenger
                ];
            }
        }

        return array_values($passengers);
    }

    /*
    |--------------------------------------------------------------------------
    | LẤY CHUYẾN BAY VÀ GHẾ ĐÃ CHỌN
    |--------------------------------------------------------------------------
    */

    private function getSelectedFlight(
        string $flightKey,
        string $seatsKey,
        string $legacySeatKey,
        int $passengerCount
    ): array {
        $flightId = session($flightKey);

        $seatIds = session(
            $seatsKey,
            []
        );

        if (!is_array($seatIds)) {
            $seatIds = [];
        }

        /*
         * Hỗ trợ seat_id của luồng một vé cũ.
         */
        if (
            count($seatIds) === 0
            && $passengerCount === 1
            && session($legacySeatKey)
        ) {
            $seatIds = [
                session($legacySeatKey)
            ];
        }

        $seatIds = array_map(
            'intval',
            $seatIds
        );

        /*
         * Kiểm tra mỗi hành khách có một ghế.
         */
        if (
            !$flightId
            || count($seatIds) !== $passengerCount
            || count(array_unique($seatIds))
                !== $passengerCount
        ) {
            throw ValidationException::withMessages([
                'seats' =>
                    'Vui lòng chọn đủ ghế cho tất cả hành khách.',
            ]);
        }

        $flight = Flight::with([
            'departureAirport',
            'arrivalAirport',
            'aircraft',
        ])->find($flightId);

        if (
            !$flight
            || $flight->status !== 'open'
        ) {
            throw ValidationException::withMessages([
                'flight' =>
                    'Chuyến bay không tồn tại hoặc không mở bán.',
            ]);
        }

        /*
         * Lấy ghế đúng chuyến bay.
         */
        $seatCollection = FlightSeat::where(
            'flight_id',
            $flight->id
        )
            ->whereIn(
                'id',
                $seatIds
            )
            ->get()
            ->keyBy('id');

        /*
         * Giữ thứ tự ghế lúc khách chọn
         * để ghép đúng từng hành khách.
         */
        $orderedSeats = collect();

        foreach ($seatIds as $seatId) {
            $seat = $seatCollection->get(
                $seatId
            );

            if (
                !$seat
                || $seat->status !== 'available'
            ) {
                throw ValidationException::withMessages([
                    'seats' =>
                        'Có ghế đã được đặt hoặc không còn hợp lệ. Vui lòng chọn lại.',
                ]);
            }

            $orderedSeats->push($seat);
        }

        return [
            $flight,
            $orderedSeats,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | THÔNG TIN HÀNH TRÌNH
    |--------------------------------------------------------------------------
    */

    private function bookingDetails(): array
    {
        $tripType = session(
            'flight_search.trip_type',
            'one_way'
        );

        $passengerCount = $this->passengerCount();

        /*
         * ĐẶT VÉ MỘT CHIỀU
         */
        if ($tripType !== 'round_trip') {
            [$flight, $seats] =
                $this->getSelectedFlight(
                    'booking.flight_id',
                    'booking.seat_ids',
                    'booking.seat_id',
                    $passengerCount
                );

            return [
                'tripType' => 'one_way',
                'passengerCount' => $passengerCount,

                'flight' => $flight,
                'seat' => $seats->first(),
                'seats' => $seats,

                'outboundFlight' => null,
                'outboundSeat' => null,
                'outboundSeats' => collect(),

                'returnFlight' => null,
                'returnSeat' => null,
                'returnSeats' => collect(),
            ];
        }

        /*
         * ĐẶT VÉ KHỨ HỒI - CHIỀU ĐI
         */
        [$outboundFlight, $outboundSeats] =
            $this->getSelectedFlight(
                'booking.outbound.flight_id',
                'booking.outbound.seat_ids',
                'booking.outbound.seat_id',
                $passengerCount
            );

        /*
         * ĐẶT VÉ KHỨ HỒI - CHIỀU VỀ
         */
        [$returnFlight, $returnSeats] =
            $this->getSelectedFlight(
                'booking.return.flight_id',
                'booking.return.seat_ids',
                'booking.return.seat_id',
                $passengerCount
            );

        return [
            'tripType' => 'round_trip',
            'passengerCount' => $passengerCount,

            /*
             * Biến tương thích giao diện cũ.
             */
            'flight' => $outboundFlight,
            'seat' => $outboundSeats->first(),
            'seats' => $outboundSeats,

            /*
             * Thông tin chiều đi.
             */
            'outboundFlight' => $outboundFlight,
            'outboundSeat' => $outboundSeats->first(),
            'outboundSeats' => $outboundSeats,

            /*
             * Thông tin chiều về.
             */
            'returnFlight' => $returnFlight,
            'returnSeat' => $returnSeats->first(),
            'returnSeats' => $returnSeats,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | HIỂN THỊ TRANG NHẬP THÔNG TIN HÀNH KHÁCH
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        try {
            $details = $this->bookingDetails();

        } catch (ValidationException $exception) {
            return redirect()
                ->route('flights.search.form')
                ->with(
                    'error',
                    $exception->validator
                        ->errors()
                        ->first()
                );
        }

        $passengers = $this->passengers();

        /*
         * Tự điền một số thông tin từ
         * tài khoản đăng nhập cho người đầu tiên.
         */
        $user = auth()->user();

        if ($user) {
            $dateOfBirth = '';

            if (!empty($user->date_of_birth)) {
                $dateOfBirth = \Carbon\Carbon::parse(
                    $user->date_of_birth
                )->format('Y-m-d');
            }

            $defaultPassenger = [
                'full_name' => $user->name ?? '',
                'date_of_birth' => $dateOfBirth,
                'gender' => $user->gender ?? '',
                'identity_number' => '',
                'phone' => $user->phone ?? '',
                'email' => $user->email ?? '',
            ];

            $passengers[0] = array_merge(
                $defaultPassenger,
                $passengers[0] ?? []
            );
        }

        /*
         * Tương thích với giao diện cũ.
         */
        $passenger = $passengers[0] ?? [];

        return view(
            'user.thong-tin-hanh-khach',
            array_merge(
                $details,
                [
                    'passengers' => $passengers,
                    'passenger' => $passenger,
                ]
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | LƯU THÔNG TIN 1–5 HÀNH KHÁCH
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        try {
            $details = $this->bookingDetails();

        } catch (ValidationException $exception) {
            return redirect()
                ->route('flights.search.form')
                ->with(
                    'error',
                    $exception->validator
                        ->errors()
                        ->first()
                );
        }

        $passengerCount =
            $details['passengerCount'];

        /*
         * Form nhập thông tin:
         *
         * passengers[0][full_name]
         * passengers[0][date_of_birth]
         * passengers[0][cccd_image]
         *
         * passengers[1][full_name]
         * passengers[1][date_of_birth]
         * passengers[1][cccd_image]
         */

        $validated = $request->validate(
            [
                'passengers' => [
                    'required',
                    'array',
                    'size:' . $passengerCount,
                ],

                'passengers.*.full_name' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'passengers.*.date_of_birth' => [
                    'required',
                    'date',
                    'before:today',
                ],

                'passengers.*.gender' => [
                    'required',
                    'in:nam,nu,khac',
                ],

                'passengers.*.identity_number' => [
                    'required',
                    'string',
                    'max:30',
                ],

                'passengers.*.phone' => [
                    'required',
                    'string',
                    'max:20',
                ],

                'passengers.*.email' => [
                    'required',
                    'email',
                    'max:255',
                ],

                'passengers.*.cccd_image' => [
                    'nullable',
                    'image',
                    'mimes:jpg,jpeg,png,webp',
                    'max:5120',
                ],
            ],
            [
                'passengers.required' =>
                    'Vui lòng nhập thông tin hành khách.',

                'passengers.size' =>
                    'Vui lòng nhập đủ '
                    . $passengerCount
                    . ' hành khách.',

                'passengers.*.full_name.required' =>
                    'Vui lòng nhập họ tên.',

                'passengers.*.date_of_birth.required' =>
                    'Vui lòng nhập ngày sinh.',

                'passengers.*.date_of_birth.before' =>
                    'Ngày sinh phải trước ngày hiện tại.',

                'passengers.*.gender.required' =>
                    'Vui lòng chọn giới tính.',

                'passengers.*.identity_number.required' =>
                    'Vui lòng nhập số CCCD hoặc hộ chiếu.',

                'passengers.*.phone.required' =>
                    'Vui lòng nhập số điện thoại.',

                'passengers.*.email.required' =>
                    'Vui lòng nhập email.',

                'passengers.*.email.email' =>
                    'Email không đúng định dạng.',

                'passengers.*.cccd_image.image' =>
                    'Tệp CCCD phải là hình ảnh.',

                'passengers.*.cccd_image.max' =>
                    'Ảnh CCCD không được vượt quá 5MB.',
            ]
        );

        /*
         * Cho phép tải cùng một ảnh CCCD
         * cho nhiều hành khách khi thử nghiệm.
         *
         * Kết quả đối chiếu dùng giấy tờ trùng
         * sẽ được đánh dấu DEMO trong môi trường local.
         */
        $oldPassengers = $this->passengers();

        /*
         * Mỗi hành khách phải có ảnh CCCD
         * mới hoặc ảnh đã lưu trước đó.
         */
        foreach (
            $validated['passengers'] as $index => $data
        ) {
            $oldImage =
                $oldPassengers[$index]['cccd_image']
                ?? null;

            if (
                !$request->hasFile(
                    "passengers.{$index}.cccd_image"
                )
                && !$oldImage
            ) {
                throw ValidationException::withMessages([
                    "passengers.{$index}.cccd_image" =>
                        'Vui lòng tải ảnh CCCD của hành khách '
                        . ($index + 1)
                        . '.',
                ]);
            }
        }

        /*
         * Thư mục lưu ảnh CCCD.
         */
        $directory = public_path(
            'uploads/cccd'
        );

        if (!File::isDirectory($directory)) {
            File::makeDirectory(
                $directory,
                0755,
                true
            );
        }

        $newPassengers = [];
        $newImagePaths = [];
        $oldImagesToDelete = [];

        try {
            foreach (
                $validated['passengers'] as $index => $data
            ) {
                $oldImage =
                    $oldPassengers[$index]['cccd_image']
                    ?? null;

                $cccdImagePath = $oldImage;

                /*
                 * Chỉ lưu ảnh mới khi người dùng
                 * thực sự tải ảnh khác.
                 */
                if (
                    $request->hasFile(
                        "passengers.{$index}.cccd_image"
                    )
                ) {
                    $file = $request->file(
                        "passengers.{$index}.cccd_image"
                    );

                    $fileName =
                        'cccd_'
                        . (auth()->id() ?? 'guest')
                        . '_'
                        . ($index + 1)
                        . '_'
                        . now()->format('YmdHis')
                        . '_'
                        . Str::lower(
                            Str::random(12)
                        )
                        . '.'
                        . $file->extension();

                    $file->move(
                        $directory,
                        $fileName
                    );

                    $cccdImagePath =
                        'uploads/cccd/'
                        . $fileName;

                    $newImagePaths[] =
                        $cccdImagePath;

                    if ($oldImage) {
                        $oldImagesToDelete[] =
                            $oldImage;
                    }
                }

                $newPassengers[] = [
                    'full_name' =>
                        trim($data['full_name']),

                    'date_of_birth' =>
                        $data['date_of_birth'],

                    'gender' =>
                        $data['gender'],

                    'identity_number' =>
                        trim($data['identity_number']),

                    'phone' =>
                        trim($data['phone']),

                    'email' =>
                        trim($data['email']),

                    'cccd_image' =>
                        $cccdImagePath,
                ];
            }

        } catch (\Throwable $exception) {
            foreach ($newImagePaths as $path) {
                if (File::exists(public_path($path))) {
                    File::delete(
                        public_path($path)
                    );
                }
            }

            throw $exception;
        }

        /*
         * Lưu toàn bộ danh sách hành khách.
         */
        session([
            'booking.passengers' =>
                $newPassengers,

            'booking.passenger' =>
                $newPassengers[0],
        ]);

        /*
         * Khi nhập lại toàn bộ form ban đầu
         * thì phải quét khuôn mặt lại.
         *
         * Phần chỉnh sửa riêng từng hành khách
         * sẽ xử lý khác tại updateConfirmation().
         */
        session()->forget([
            'booking.face_status',
            'booking.face_image',
            'booking.face_verification_hash',

            'booking.face_statuses',
            'booking.face_images',
            'booking.face_verification_hashes',
            'booking.is_demo',
        ]);

        /*
         * Xóa ảnh CCCD cũ đã được thay thế.
         * Không xóa nếu còn người khác sử dụng.
         */
        foreach (
            array_unique($oldImagesToDelete) as $oldImage
        ) {
            $stillUsed = false;

            foreach ($newPassengers as $person) {
                if (
                    ($person['cccd_image'] ?? null)
                    === $oldImage
                ) {
                    $stillUsed = true;
                    break;
                }
            }

            if ($stillUsed) {
                continue;
            }

            if (
                Str::startsWith(
                    $oldImage,
                    'uploads/cccd/'
                )
                && File::exists(
                    public_path($oldImage)
                )
            ) {
                File::delete(
                    public_path($oldImage)
                );
            }
        }

        return redirect()
            ->route('baggage.create');
    }

    /*
    |--------------------------------------------------------------------------
    | XÁC NHẬN ĐẶT VÉ
    |--------------------------------------------------------------------------
    */

    public function confirm()
    {
        $passengers = $this->passengers();

        $passengerCount =
            $this->passengerCount();

        if (
            count($passengers)
            !== $passengerCount
        ) {
            return redirect()
                ->route('passenger.create')
                ->with(
                    'error',
                    'Vui lòng nhập đầy đủ thông tin tất cả hành khách.'
                );
        }

        foreach (
            $passengers as $index => $person
        ) {
            if (
                empty($person['cccd_image'])
            ) {
                return redirect()
                    ->route('passenger.create')
                    ->with(
                        'error',
                        'Hành khách '
                        . ($index + 1)
                        . ' chưa có ảnh CCCD.'
                    );
            }
        }

        /*
         * Kiểm tra các hành khách
         * đã hoàn thành quét khuôn mặt.
         */
        $statuses = session(
            'booking.face_statuses',
            []
        );

        if (!is_array($statuses)) {
            $statuses = [];
        }

        if (
            $passengerCount === 1
            && empty($statuses)
            && session('booking.face_status')
        ) {
            $statuses = [
                session('booking.face_status')
            ];
        }

        for (
            $i = 0;
            $i < $passengerCount;
            $i++
        ) {
            if (
                !in_array(
                    $statuses[$i] ?? null,
                    ['verified', 'demo'],
                    true
                )
            ) {
                return redirect()
                    ->route('face.create')
                    ->with(
                        'error',
                        'Vui lòng hoàn tất đối chiếu khuôn mặt cho tất cả hành khách.'
                    );
            }
        }

        try {
            $details = $this->bookingDetails();

        } catch (ValidationException $exception) {
            return redirect()
                ->route('flights.search.form')
                ->with(
                    'error',
                    $exception->validator
                        ->errors()
                        ->first()
                );
        }

        return view(
            'user.xac-nhan-dat-ve',
            array_merge(
                $details,
                [
                    'passenger' =>
                        $passengers[0],

                    'passengers' =>
                        $passengers,
                ]
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | CHỈNH SỬA THÔNG TIN TRỰC TIẾP TRONG KHUNG XÁC NHẬN
    |--------------------------------------------------------------------------
    |
    | Không thay ảnh CCCD.
    | Không thay ghế.
    | Không thay hành lý.
    | Không tạo vé mới.
    |
    | QUAN TRỌNG:
    | Chỉ người được chỉnh sửa thông tin định danh
    | mới phải quét khuôn mặt lại.
    |
    */

    public function updateConfirmation(
        Request $request,
        int $index
    ) {
        $count = $this->passengerCount();

        /*
         * Kiểm tra index hành khách.
         */
        if (
            $index < 0
            || $index >= $count
        ) {
            abort(404);
        }

        $passengers = $this->passengers();

        if (
            count($passengers) !== $count
            || !isset($passengers[$index])
            || !is_array($passengers[$index])
        ) {
            return redirect()
                ->route('passenger.create')
                ->with(
                    'error',
                    'Không tìm thấy thông tin hành khách cần chỉnh sửa.'
                );
        }

        /*
         * Thông tin cũ trước khi chỉnh sửa.
         */
        $oldPassenger =
            $passengers[$index];

        /*
         * Không chỉnh sửa hình CCCD ở trang này.
         */
        if (
            empty($oldPassenger['cccd_image'])
        ) {
            return redirect()
                ->route('passenger.create')
                ->with(
                    'error',
                    'Hành khách chưa có ảnh CCCD.'
                );
        }

        /*
         * Kiểm tra các trường được phép sửa.
         */
        $validated = $request->validate(
            [
                'full_name' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'date_of_birth' => [
                    'required',
                    'date',
                    'before:today',
                ],

                'gender' => [
                    'required',
                    'in:nam,nu,khac',
                ],

                'identity_number' => [
                    'required',
                    'string',
                    'max:30',
                ],

                'phone' => [
                    'required',
                    'string',
                    'max:20',
                ],

                'email' => [
                    'required',
                    'email',
                    'max:255',
                ],
            ],
            [
                'full_name.required' =>
                    'Vui lòng nhập họ và tên.',

                'date_of_birth.required' =>
                    'Vui lòng nhập ngày sinh.',

                'date_of_birth.before' =>
                    'Ngày sinh phải trước ngày hiện tại.',

                'gender.required' =>
                    'Vui lòng chọn giới tính.',

                'identity_number.required' =>
                    'Vui lòng nhập CCCD hoặc hộ chiếu.',

                'phone.required' =>
                    'Vui lòng nhập số điện thoại.',

                'email.required' =>
                    'Vui lòng nhập email.',

                'email.email' =>
                    'Email không đúng định dạng.',
            ]
        );

        /*
         * Chuẩn hóa dữ liệu trước khi lưu.
         */
        $validated['full_name'] = trim(
            $validated['full_name']
        );

        $validated['identity_number'] = trim(
            $validated['identity_number']
        );

        $validated['phone'] = trim(
            $validated['phone']
        );

        $validated['email'] = trim(
            $validated['email']
        );

        /*
         * Kiểm tra thông tin định danh có đổi không.
         *
         * Các trường cần quét lại nếu thay đổi:
         * - Họ tên
         * - Ngày sinh
         * - Giới tính
         * - Số CCCD / Hộ chiếu
         *
         * Chỉ đổi email hoặc số điện thoại
         * thì không cần quét khuôn mặt lại.
         */
        $identityChanged =
            trim(
                (string) (
                    $oldPassenger['full_name']
                    ?? ''
                )
            ) !== $validated['full_name']

            || (
                (string) (
                    $oldPassenger['date_of_birth']
                    ?? ''
                )
                !== $validated['date_of_birth']
            )

            || (
                (string) (
                    $oldPassenger['gender']
                    ?? ''
                )
                !== $validated['gender']
            )

            || (
                trim(
                    (string) (
                        $oldPassenger['identity_number']
                        ?? ''
                    )
                )
                !== $validated['identity_number']
            );

        /*
         * Lấy kết quả xác thực khuôn mặt
         * đã lưu cho toàn bộ hành khách.
         */
        $statuses = session(
            'booking.face_statuses',
            []
        );

        $hashes = session(
            'booking.face_verification_hashes',
            []
        );

        $images = session(
            'booking.face_images',
            []
        );

        if (!is_array($statuses)) {
            $statuses = [];
        }

        if (!is_array($hashes)) {
            $hashes = [];
        }

        if (!is_array($images)) {
            $images = [];
        }

        /*
         * Tương thích luồng đặt một vé cũ.
         */
        if (
            $count === 1
            && empty($statuses)
            && session('booking.face_status')
        ) {
            $statuses[0] =
                session('booking.face_status');

            $hashes[0] =
                session('booking.face_verification_hash');

            $images[0] =
                session('booking.face_image');
        }

        /*
         * Xác minh kết quả cũ thực sự hợp lệ
         * trước khi giữ lại sau khi sửa email/phone.
         */
        $oldFaceImage = $images[$index] ?? null;
        $oldHash = $hashes[$index] ?? null;
        $oldStatus = $statuses[$index] ?? null;

        $actualOldHash =
            is_string($oldFaceImage)
                ? EnsureBookingFaceVerified::fingerprint(
                    $oldPassenger,
                    $oldFaceImage
                )
                : null;

        $oldVerificationValid =
            in_array(
                $oldStatus,
                ['verified', 'demo'],
                true
            )

            && is_string($oldHash)

            && is_string($actualOldHash)

            && hash_equals(
                $oldHash,
                $actualOldHash
            )

            && (
                $oldStatus !== 'demo'
                || app()->environment('local')
            );

        /*
         * Cập nhật đúng hành khách đang sửa.
         *
         * array_merge giữ nguyên cccd_image
         * cùng các trường dữ liệu khác.
         */
        $passengers[$index] = array_merge(
            $oldPassenger,
            [
                'full_name' =>
                    $validated['full_name'],

                'date_of_birth' =>
                    $validated['date_of_birth'],

                'gender' =>
                    $validated['gender'],

                'identity_number' =>
                    $validated['identity_number'],

                'phone' =>
                    $validated['phone'],

                'email' =>
                    $validated['email'],
            ]
        );

        /*
         * Lưu thông tin mới vào Session.
         * BookingController sẽ lấy dữ liệu này
         * khi tạo các vé trong cơ sở dữ liệu.
         */
        session([
            'booking.passengers' =>
                $passengers,

            'booking.passenger' =>
                $passengers[0],
        ]);

        /*
        |--------------------------------------------------------------------------
        | TRƯỜNG HỢP 1:
        | CHỈ SỬA SỐ ĐIỆN THOẠI HOẶC EMAIL
        |--------------------------------------------------------------------------
        |
        | Nếu kết quả quét trước đó hợp lệ,
        | cập nhật fingerprint mới.
        |
        | Không bắt người dùng quét lại.
        |
        */

        if (
            !$identityChanged
            && $oldVerificationValid
        ) {
            $newFingerprint =
                EnsureBookingFaceVerified::fingerprint(
                    $passengers[$index],
                    $oldFaceImage
                );

            if ($newFingerprint) {
                $statuses[$index] = $oldStatus;

                $hashes[$index] =
                    $newFingerprint;

                $images[$index] =
                    $oldFaceImage;

                session([
                    'booking.face_statuses' =>
                        $statuses,

                    'booking.face_verification_hashes' =>
                        $hashes,

                    'booking.face_images' =>
                        $images,
                ]);

                /*
                 * Hỗ trợ luồng một vé.
                 */
                if ($count === 1) {
                    session([
                        'booking.face_status' =>
                            $oldStatus,

                        'booking.face_verification_hash' =>
                            $newFingerprint,

                        'booking.face_image' =>
                            $oldFaceImage,
                    ]);
                }

                return redirect()
                    ->route('booking.confirm')
                    ->with(
                        'success',
                        'Đã cập nhật thông tin hành khách '
                        . ($index + 1)
                        . ' thành công.'
                    );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | TRƯỜNG HỢP 2:
        | SỬA THÔNG TIN ĐỊNH DANH
        |--------------------------------------------------------------------------
        |
        | CHỈ XÓA KẾT QUẢ QUÉT CỦA HÀNH KHÁCH
        | VỪA CHỈNH SỬA.
        |
        | Không xóa kết quả những người khác.
        |
        | Ví dụ:
        | - Sửa hành khách 1 => chỉ quét lại người 1.
        | - Sửa hành khách 2 => chỉ quét lại người 2.
        | - Sửa hành khách 3 => chỉ quét lại người 3.
        |
        */

        unset(
            $statuses[$index],
            $hashes[$index],
            $images[$index]
        );

        /*
         * Những hành khách khác giữ nguyên:
         * booking.face_statuses
         * booking.face_verification_hashes
         * booking.face_images
         */
        session([
            'booking.face_statuses' =>
                $statuses,

            'booking.face_verification_hashes' =>
                $hashes,

            'booking.face_images' =>
                $images,

            /*
             * Nếu còn bất kỳ người nào đang dùng
             * dữ liệu DEMO thì giữ trạng thái DEMO.
             */
            'booking.is_demo' =>
                in_array(
                    'demo',
                    $statuses,
                    true
                ),
        ]);

        /*
         * Hỗ trợ luồng đặt một vé cũ.
         */
        if ($count === 1) {
            session()->forget([
                'booking.face_status',
                'booking.face_verification_hash',
                'booking.face_image',
            ]);
        }

        /*
         * Chuyển sang quét đúng người vừa sửa.
         *
         * FaceController::create()
         * sẽ tìm người chưa có trạng thái xác thực.
         *
         * Vì chỉ xóa kết quả của $index,
         * các hành khách còn lại không phải quét lại.
         */
        return redirect()
            ->route('face.create')
            ->with(
                'success',
                'Đã lưu thông tin hành khách '
                . ($index + 1)
                . '. Vui lòng xác thực lại khuôn mặt '
                . 'của hành khách này.'
            );
    }
}
