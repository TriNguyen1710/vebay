<?php

namespace App\Http\Controllers;

use App\Http\Middleware\EnsureBookingFaceVerified;
use App\Models\Flight;
use App\Models\FlightSeat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Str;

class FaceController extends Controller
{
    private function passengerCount(): int
    {
        return max(1, min(5, (int) session('flight_search.passenger_count', 1)));
    }

    private function passengers(): array
    {
        $count = $this->passengerCount();
        $passengers = session('booking.passengers', []);

        if (!is_array($passengers)) {
            $passengers = [];
        }

        if ($count === 1 && !$passengers && is_array(session('booking.passenger'))) {
            $passengers = [session('booking.passenger')];
        }

        return array_values($passengers);
    }

    private function selectedLeg(string $key, string $seatIdsKey, string $seatIdKey): ?array
    {
        $flightId = session($key);
        $ids = session($seatIdsKey, []);

        if (!is_array($ids)) {
            $ids = [];
        }

        if (!$ids && $this->passengerCount() === 1 && session($seatIdKey)) {
            $ids = [session($seatIdKey)];
        }

        $ids = array_map('intval', $ids);
        $count = $this->passengerCount();

        if (!$flightId || count($ids) !== $count || count(array_unique($ids)) !== $count) {
            return null;
        }

        $flight = Flight::with([
            'departureAirport',
            'arrivalAirport',
            'aircraft',
        ])->find($flightId);

        if (!$flight || $flight->status !== 'open') {
            return null;
        }

        $byId = FlightSeat::where('flight_id', $flight->id)
            ->whereIn('id', $ids)
            ->get()
            ->keyBy('id');

        $seats = collect();

        foreach ($ids as $id) {
            $seat = $byId->get($id);

            if (!$seat || $seat->status !== 'available') {
                return null;
            }

            $seats->push($seat);
        }

        return [$flight, $seats];
    }

    /**
     * Hiện camera cho hành khách chưa xác thực đầu tiên.
     * Không xoá kết quả các hành khách đã hoàn thành.
     */
    public function create()
    {
        $tripType = session('flight_search.trip_type', 'one_way');
        $passengerCount = $this->passengerCount();
        $passengers = $this->passengers();

        if (count($passengers) !== $passengerCount) {
            return redirect()
                ->route('passenger.create')
                ->with('error', 'Vui lòng nhập thông tin đầy đủ cho tất cả hành khách.');
        }

        foreach ($passengers as $person) {
            if (empty($person['cccd_image'])) {
                return redirect()
                    ->route('passenger.create')
                    ->with('error', 'Vui lòng tải ảnh CCCD cho từng hành khách.');
            }
        }

        $outbound = $tripType === 'round_trip'
            ? $this->selectedLeg(
                'booking.outbound.flight_id',
                'booking.outbound.seat_ids',
                'booking.outbound.seat_id'
            )
            : $this->selectedLeg(
                'booking.flight_id',
                'booking.seat_ids',
                'booking.seat_id'
            );

        if (!$outbound) {
            return redirect()
                ->route('flights.search.form')
                ->with('error', 'Chuyến bay hoặc các ghế đã chọn không còn hợp lệ.');
        }

        $return = $tripType === 'round_trip'
            ? $this->selectedLeg(
                'booking.return.flight_id',
                'booking.return.seat_ids',
                'booking.return.seat_id'
            )
            : null;

        if ($tripType === 'round_trip' && !$return) {
            return redirect()
                ->route('flights.search.form')
                ->with('error', 'Chuyến về hoặc các ghế đã chọn không còn hợp lệ.');
        }

        [$flight, $seats] = $outbound;

        $seat = $seats->first();

        $outboundFlight = $tripType === 'round_trip'
            ? $flight
            : null;

        $outboundSeats = $tripType === 'round_trip'
            ? $seats
            : collect();

        $outboundSeat = $outboundSeats->first();

        $returnFlight = $return[0] ?? null;
        $returnSeats = $return[1] ?? collect();
        $returnSeat = $returnSeats->first();

        $statuses = session('booking.face_statuses', []);
        $hashes = session('booking.face_verification_hashes', []);
        $images = session('booking.face_images', []);

        if (!is_array($statuses)) {
            $statuses = [];
        }

        if (!is_array($hashes)) {
            $hashes = [];
        }

        if (!is_array($images)) {
            $images = [];
        }

        // Kiểm tra dấu vân tay của từng kết quả.
        for ($i = 0; $i < $passengerCount; $i++) {
            $hash = isset($images[$i]) && is_string($images[$i])
                ? EnsureBookingFaceVerified::fingerprint($passengers[$i], $images[$i])
                : null;

            if (
                !in_array($statuses[$i] ?? null, ['verified', 'demo'], true)
                || !$hash
                || !is_string($hashes[$i] ?? null)
                || !hash_equals($hashes[$i], $hash)
                || (
                    ($statuses[$i] ?? null) === 'demo'
                    && !app()->environment('local')
                )
            ) {
                unset($statuses[$i], $hashes[$i], $images[$i]);
            }
        }

        session([
            'booking.face_statuses' => $statuses,
            'booking.face_verification_hashes' => $hashes,
            'booking.face_images' => $images,
        ]);

        $currentIndex = null;

        for ($i = 0; $i < $passengerCount; $i++) {
            if (!isset($statuses[$i])) {
                $currentIndex = $i;
                break;
            }
        }

        $allVerified = $currentIndex === null;

        if ($allVerified) {
            return redirect()->route('booking.confirm');
        }

        $currentIndex ??= $passengerCount - 1;

        $passenger = $passengers[$currentIndex];
        $seat = $seats->values()->get($currentIndex);

        if ($tripType === 'round_trip') {
            $outboundSeat = $outboundSeats->values()->get($currentIndex);
            $returnSeat = $returnSeats->values()->get($currentIndex);
        }

        return view(
            'user.quet-khuon-mat',
            compact(
                'tripType',
                'flight',
                'seat',
                'seats',
                'outboundFlight',
                'outboundSeat',
                'outboundSeats',
                'returnFlight',
                'returnSeat',
                'returnSeats',
                'passenger',
                'passengers',
                'passengerCount',
                'currentIndex',
                'statuses',
                'allVerified'
            )
        );
    }

    public function store(Request $request)
    {
        set_time_limit(120);

        $count = $this->passengerCount();
        $passengers = $this->passengers();
        $index = (int) $request->input('passenger_index', -1);

        if (
            count($passengers) !== $count
            || $index < 0
            || $index >= $count
        ) {
            return $this->verificationFailure(
                $request,
                'Hành khách không hợp lệ. Vui lòng nhập thông tin lại.',
                'passenger.create'
            );
        }

        $passenger = $passengers[$index];

        if (empty($passenger['cccd_image'])) {
            return $this->verificationFailure(
                $request,
                'Hành khách chưa có ảnh CCCD.',
                'passenger.create'
            );
        }

        $statuses = session('booking.face_statuses', []);
        $hashes = session('booking.face_verification_hashes', []);
        $images = session('booking.face_images', []);

        if (!is_array($statuses)) {
            $statuses = [];
        }

        if (!is_array($hashes)) {
            $hashes = [];
        }

        if (!is_array($images)) {
            $images = [];
        }

        // Bắt buộc xác thực theo thứ tự hành khách.
        for ($i = 0; $i < $index; $i++) {
            $hash = isset($images[$i]) && is_string($images[$i])
                ? EnsureBookingFaceVerified::fingerprint(
                    $passengers[$i],
                    $images[$i]
                )
                : null;

            if (
                !in_array($statuses[$i] ?? null, ['verified', 'demo'], true)
                || !$hash
                || !is_string($hashes[$i] ?? null)
                || !hash_equals($hashes[$i], $hash)
            ) {
                return $this->verificationFailure(
                    $request,
                    'Vui lòng xác thực lần lượt từ hành khách đầu tiên.'
                );
            }
        }

        // Chụp lại chỉ xoá kết quả người đang quét.
        if ($request->input('action') === 'reset') {
            $this->clearPassengerVerification($index);

            return response()->json([
                'success' => true,
            ]);
        }

        $this->clearPassengerVerification($index);

        $request->validate(
            [
                'face_image' => [
                    'required',
                    'string',
                    'max:7000000',
                ],
            ],
            [
                'face_image.required' =>
                    'Vui lòng chụp khuôn mặt trước khi tiếp tục.',

                'face_image.string' =>
                    'Dữ liệu khuôn mặt không hợp lệ.',

                'face_image.max' =>
                    'Ảnh khuôn mặt vượt quá dung lượng cho phép.',
            ]
        );

        $imageData = $request->input('face_image');

        if (!preg_match('/^data:image\/(jpeg|jpg|png|webp);base64,/', $imageData)) {
            return $this->verificationFailure(
                $request,
                'Ảnh khuôn mặt không hợp lệ. Vui lòng chụp lại.'
            );
        }

        $decodedImage = base64_decode(
            substr($imageData, strpos($imageData, ',') + 1),
            true
        );

        if (
            $decodedImage === false
            || strlen($decodedImage) > 5 * 1024 * 1024
        ) {
            return $this->verificationFailure(
                $request,
                'Ảnh khuôn mặt không hợp lệ hoặc vượt quá 5MB.'
            );
        }

        $imageInfo = @getimagesizefromstring($decodedImage);

        $extensions = [
            IMAGETYPE_JPEG => 'jpg',
            IMAGETYPE_PNG => 'png',
            IMAGETYPE_WEBP => 'webp',
        ];

        if (!$imageInfo || !isset($extensions[$imageInfo[2]])) {
            return $this->verificationFailure(
                $request,
                'Không đọc được ảnh khuôn mặt. Vui lòng chụp lại.'
            );
        }

        $cccdPath = EnsureBookingFaceVerified::imagePath(
            $passenger['cccd_image'],
            'uploads/cccd'
        );

        if (!$cccdPath) {
            return $this->verificationFailure(
                $request,
                'Không tìm thấy ảnh CCCD. Vui lòng tải lại.',
                'passenger.create'
            );
        }

        // Giữ nguyên Python và model nhận diện đang sử dụng.
        $pythonPath = 'C:\\Users\\tring\\AppData\\Local\\Programs\\Python\\Python312\\python.exe';

        $scriptPath = base_path('python/face_verify.py');

        $detectorModel = storage_path(
            'app/face-models/face_detection_yunet_2023mar.onnx'
        );

        $recognizerModel = storage_path(
            'app/face-models/face_recognition_sface_2021dec.onnx'
        );

        foreach (
            [
                $pythonPath,
                $scriptPath,
                $detectorModel,
                $recognizerModel,
            ] as $requiredFile
        ) {
            if (!is_file($requiredFile)) {
                return $this->verificationFailure(
                    $request,
                    'Thiếu Python, script hoặc model nhận diện. Vui lòng kiểm tra cấu hình.'
                );
            }
        }

        $relativePath =
            'uploads/faces/face_'
            . auth()->id()
            . '_p'
            . ($index + 1)
            . '_'
            . now()->format('YmdHis')
            . '_'
            . Str::lower(Str::random(8))
            . '.'
            . $extensions[$imageInfo[2]];

        $fullPath = public_path($relativePath);
        $verified = false;

        try {
            File::ensureDirectoryExists(
                public_path('uploads/faces'),
                0755,
                true
            );

            if (File::put($fullPath, $decodedImage) === false) {
                return $this->verificationFailure(
                    $request,
                    'Không thể lưu ảnh khuôn mặt. Vui lòng thử lại.'
                );
            }

            $result = Process::timeout(90)
                ->env([
                    'PYTHONUTF8' => '1',
                    'PYTHONIOENCODING' => 'utf-8',
                ])
                ->run([
                    $pythonPath,
                    $scriptPath,
                    $cccdPath,
                    $fullPath,
                    $detectorModel,
                    $recognizerModel,
                ]);

            $verification = json_decode(
                trim($result->output()),
                true
            );

            if (
                !$result->successful()
                || !is_array($verification)
                || ($verification['success'] ?? false) !== true
            ) {
                $message = is_array($verification)
                    ? ($verification['message'] ?? '')
                    : '';

                if (str_contains($message, 'anh da dang ky')) {
                    return $this->verificationFailure(
                        $request,
                        'Không nhận diện được khuôn mặt trên CCCD. Hãy tải ảnh mặt trước rõ nét.'
                    );
                }

                if (str_contains($message, 'anh vua chup')) {
                    return $this->verificationFailure(
                        $request,
                        'Không nhận diện được khuôn mặt vừa chụp. Hãy nhìn thẳng và đủ sáng.'
                    );
                }

                return $this->verificationFailure(
                    $request,
                    'Chưa thể đối chiếu khuôn mặt. Vui lòng kiểm tra Python và model.'
                );
            }

            if (($verification['matched'] ?? false) !== true) {
                return $this->verificationFailure(
                    $request,
                    'Khuôn mặt không khớp ảnh CCCD. Vui lòng chụp lại.'
                );
            }

            $fingerprint = EnsureBookingFaceVerified::fingerprint(
                $passenger,
                $relativePath
            );

            if (!$fingerprint) {
                return $this->verificationFailure(
                    $request,
                    'Không xác nhận được dữ liệu ảnh. Vui lòng thử lại.'
                );
            }

            // Ảnh CCCD trùng nhau = dữ liệu DEMO,
            // không xác nhận nhiều danh tính thật.
            $duplicateDocument = false;
            $currentImageHash = hash_file('sha256', $cccdPath);

            foreach ($passengers as $otherIndex => $other) {
                if ($otherIndex === $index) {
                    continue;
                }

                $otherPath = EnsureBookingFaceVerified::imagePath(
                    $other['cccd_image'] ?? '',
                    'uploads/cccd'
                );

                if (
                    $otherPath
                    && $currentImageHash === hash_file('sha256', $otherPath)
                ) {
                    $duplicateDocument = true;
                    break;
                }
            }

            if (
                $duplicateDocument
                && !app()->environment('local')
            ) {
                return $this->verificationFailure(
                    $request,
                    'Ảnh CCCD trùng cho các danh tính khác nhau. Không thể xác minh danh tính thật.'
                );
            }

            $status = $duplicateDocument
                ? 'demo'
                : 'verified';

            $oldFaceImage = session(
                "booking.face_images.{$index}"
            );

            $statuses = session('booking.face_statuses', []);
            $hashes = session('booking.face_verification_hashes', []);
            $images = session('booking.face_images', []);

            if (!is_array($statuses)) {
                $statuses = [];
            }

            if (!is_array($hashes)) {
                $hashes = [];
            }

            if (!is_array($images)) {
                $images = [];
            }

            $statuses[$index] = $status;
            $hashes[$index] = $fingerprint;
            $images[$index] = $relativePath;

            session([
                'booking.face_statuses' => $statuses,
                'booking.face_verification_hashes' => $hashes,
                'booking.face_images' => $images,
                'booking.is_demo' =>
                    in_array('demo', $statuses, true),
            ]);

            // Session cũ chỉ dùng cho một hành khách.
            if ($count === 1) {
                session([
                    'booking.face_image' => $relativePath,
                    'booking.face_status' => 'verified',
                    'booking.face_verification_hash' => $fingerprint,
                ]);
            }

            $verified = true;

            if (
                $oldFaceImage
                && $oldFaceImage !== $relativePath
            ) {
                $oldPath = EnsureBookingFaceVerified::imagePath(
                    $oldFaceImage,
                    'uploads/faces'
                );

                if ($oldPath) {
                    File::delete($oldPath);
                }
            }

            $completed = count(
                array_filter(
                    $statuses,
                    fn ($s) => in_array(
                        $s,
                        ['verified', 'demo'],
                        true
                    )
                )
            );

            $allVerified = $completed === $count;

            $message = $status === 'demo'
                ? 'Đối chiếu ảnh thành công '
                : 'Khuôn mặt khớp ảnh CCCD!';

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'matched' => true,
                    'demo' => $status === 'demo',
                    'all_verified' => $allVerified,
                    'completed' => $completed,
                    'total' => $count,
                    'message' => $message,
                ]);
            }

            return redirect()
                ->route(
                    $allVerified
                        ? 'booking.confirm'
                        : 'face.create'
                )
                ->with('success', $message);

        } catch (\Throwable $exception) {
            report($exception);

            return $this->verificationFailure(
                $request,
                'Đối chiếu chưa hoàn tất. Vui lòng thử lại và kiểm tra Python.'
            );

        } finally {
            if (!$verified && is_file($fullPath)) {
                File::delete($fullPath);
            }
        }
    }

    private function clearPassengerVerification(int $index): void
    {
        $oldImage = session("booking.face_images.{$index}");

        $statuses = session('booking.face_statuses', []);
        $hashes = session('booking.face_verification_hashes', []);
        $images = session('booking.face_images', []);

        if (!is_array($statuses)) {
            $statuses = [];
        }

        if (!is_array($hashes)) {
            $hashes = [];
        }

        if (!is_array($images)) {
            $images = [];
        }

        unset(
            $statuses[$index],
            $hashes[$index],
            $images[$index]
        );

        session([
            'booking.face_statuses' => $statuses,
            'booking.face_verification_hashes' => $hashes,
            'booking.face_images' => $images,
            'booking.is_demo' =>
                in_array('demo', $statuses, true),
        ]);

        if ($this->passengerCount() === 1) {
            session()->forget([
                'booking.face_image',
                'booking.face_status',
                'booking.face_verification_hash',
            ]);
        }

        if ($oldImage) {
            $path = EnsureBookingFaceVerified::imagePath(
                $oldImage,
                'uploads/faces'
            );

            if ($path) {
                File::delete($path);
            }
        }
    }

    private function verificationFailure(
        Request $request,
        string $message,
        ?string $route = null
    ) {
        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'matched' => false,
                'message' => $message,
            ], 422);
        }

        return (
            $route
                ? redirect()->route($route)
                : back()
        )->with('error', $message);
    }
}
