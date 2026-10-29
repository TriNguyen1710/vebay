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
    public function create()
    {
        session()->forget([
            'booking.face_status',
            'booking.face_verification_hash',
        ]);

        $tripType = session('flight_search.trip_type', 'one_way');
        $passenger = session('booking.passenger');

        if (!$passenger) {
            return redirect()
                ->route('passenger.create')
                ->with('error', 'Vui lòng nhập thông tin hành khách trước.');
        }

        if (empty($passenger['cccd_image'])) {
            return redirect()
                ->route('passenger.create')
                ->with('error', 'Vui lòng tải lên hình ảnh CCCD trước.');
        }

        if ($tripType !== 'round_trip') {
            $flightId = session('booking.flight_id');
            $seatId = session('booking.seat_id');

            if (!$flightId || !$seatId) {
                return redirect()
                    ->route('flights.search.form')
                    ->with('error', 'Vui lòng hoàn thành thông tin đặt vé trước.');
            }

            $flight = Flight::with([
                'departureAirport',
                'arrivalAirport',
                'aircraft',
            ])->find($flightId);

            $seat = FlightSeat::where('id', $seatId)
                ->where('flight_id', $flightId)
                ->first();

            if (!$flight || !$seat) {
                session()->forget('booking');

                return redirect()
                    ->route('flights.search.form')
                    ->with('error', 'Thông tin chuyến bay hoặc ghế không còn hợp lệ.');
            }

            if ($flight->status !== 'open') {
                return redirect()
                    ->route('flights.search.form')
                    ->with('error', 'Chuyến bay này hiện không thể đặt vé.');
            }

            if ($seat->status !== 'available') {
                session()->forget('booking.seat_id');

                return redirect()
                    ->route('seats.show', $flight->id)
                    ->with('error', 'Ghế này không còn trống. Vui lòng chọn ghế khác.');
            }

            $outboundFlight = null;
            $outboundSeat = null;
            $returnFlight = null;
            $returnSeat = null;

            return view(
                'user.quet-khuon-mat',
                compact(
                    'tripType',
                    'flight',
                    'seat',
                    'outboundFlight',
                    'outboundSeat',
                    'returnFlight',
                    'returnSeat',
                    'passenger'
                )
            );
        }

        $outboundFlightId = session('booking.outbound.flight_id');
        $outboundSeatId = session('booking.outbound.seat_id');
        $returnFlightId = session('booking.return.flight_id');
        $returnSeatId = session('booking.return.seat_id');

        if (
            !$outboundFlightId
            || !$outboundSeatId
            || !$returnFlightId
            || !$returnSeatId
        ) {
            return redirect()
                ->route('flights.search.form')
                ->with('error', 'Thông tin đặt vé khứ hồi chưa đầy đủ.');
        }

        $outboundFlight = Flight::with([
            'departureAirport',
            'arrivalAirport',
            'aircraft',
        ])->find($outboundFlightId);

        $outboundSeat = FlightSeat::where('id', $outboundSeatId)
            ->where('flight_id', $outboundFlightId)
            ->first();

        $returnFlight = Flight::with([
            'departureAirport',
            'arrivalAirport',
            'aircraft',
        ])->find($returnFlightId);

        $returnSeat = FlightSeat::where('id', $returnSeatId)
            ->where('flight_id', $returnFlightId)
            ->first();

        if (
            !$outboundFlight
            || !$outboundSeat
            || !$returnFlight
            || !$returnSeat
        ) {
            session()->forget('booking');

            return redirect()
                ->route('flights.search.form')
                ->with('error', 'Thông tin chuyến bay hoặc ghế không còn hợp lệ.');
        }

        if (
            $outboundFlight->status !== 'open'
            || $returnFlight->status !== 'open'
        ) {
            return redirect()
                ->route('flights.search.form')
                ->with('error', 'Một trong các chuyến bay hiện không thể đặt vé.');
        }

        if ($outboundSeat->status !== 'available') {
            session()->forget([
                'booking.outbound.seat_id',
                'booking.return.flight_id',
                'booking.return.seat_id',
            ]);

            return redirect()
                ->route('seats.show', [
                    'flight' => $outboundFlight->id,
                    'leg' => 'outbound',
                ])
                ->with('error', 'Ghế chiều đi không còn trống. Vui lòng chọn ghế khác.');
        }

        if ($returnSeat->status !== 'available') {
            session()->forget('booking.return.seat_id');

            return redirect()
                ->route('seats.show', [
                    'flight' => $returnFlight->id,
                    'leg' => 'return',
                ])
                ->with('error', 'Ghế chiều về không còn trống. Vui lòng chọn ghế khác.');
        }

        $flight = $outboundFlight;
        $seat = $outboundSeat;

        return view(
            'user.quet-khuon-mat',
            compact(
                'tripType',
                'flight',
                'seat',
                'outboundFlight',
                'outboundSeat',
                'returnFlight',
                'returnSeat',
                'passenger'
            )
        );
    }

    public function store(Request $request)
    {
        set_time_limit(120);

        session()->forget([
            'booking.face_status',
            'booking.face_verification_hash',
        ]);

        // Chụp lại thì hủy kết quả xác thực của ảnh trước trên máy chủ.
        if ($request->input('action') === 'reset') {
            return response()->json(['success' => true]);
        }

        $passenger = session('booking.passenger');

        if (!$passenger || empty($passenger['cccd_image'])) {
            return $this->verificationFailure(
                $request,
                'Vui lòng nhập thông tin và tải ảnh mặt trước CCCD.',
                'passenger.create'
            );
        }

        $request->validate(
            ['face_image' => ['required', 'string', 'max:7000000']],
            [
                'face_image.required' => 'Vui lòng chụp khuôn mặt trước khi tiếp tục.',
                'face_image.string' => 'Dữ liệu khuôn mặt không hợp lệ.',
                'face_image.max' => 'Ảnh khuôn mặt vượt quá dung lượng cho phép.',
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

        if ($decodedImage === false || strlen($decodedImage) > 5 * 1024 * 1024) {
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
                'Không tìm thấy ảnh CCCD. Vui lòng quay lại thông tin hành khách và tải ảnh mặt trước.',
                'passenger.create'
            );
        }

        $pythonPath = 'C:\Users\tring\AppData\Local\Programs\Python\Python312\python.exe';

        $scriptPath = base_path('python/face_verify.py');

        $detectorModel = storage_path(
            'app/face-models/face_detection_yunet_2023mar.onnx'
        );

        $recognizerModel = storage_path(
            'app/face-models/face_recognition_sface_2021dec.onnx'
        );

        foreach ([$pythonPath, $scriptPath, $detectorModel, $recognizerModel] as $requiredFile) {
            if (!is_file($requiredFile)) {
                return $this->verificationFailure(
                    $request,
                    'Thiếu Python, script hoặc model nhận diện. Vui lòng kiểm tra cấu hình hệ thống.'
                );
            }
        }

        $relativePath = 'uploads/faces/face_' . auth()->id() . '_'
            . now()->format('YmdHis') . '_' . Str::lower(Str::random(8))
            . '.' . $extensions[$imageInfo[2]];

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

            $verification = json_decode(trim($result->output()), true);

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
                        'Không nhận diện được khuôn mặt trên CCCD. Hãy quay lại tải ảnh mặt trước rõ nét, không bị lóa.'
                    );
                }

                if (str_contains($message, 'anh vua chup')) {
                    return $this->verificationFailure(
                        $request,
                        'Không nhận diện được khuôn mặt vừa chụp. Hãy nhìn thẳng, đủ sáng và chụp lại.'
                    );
                }

                return $this->verificationFailure(
                    $request,
                    'Chưa thể đối chiếu khuôn mặt. Vui lòng thử lại hoặc kiểm tra Python và model nhận diện.'
                );
            }

            if (($verification['matched'] ?? false) !== true) {
                return $this->verificationFailure(
                    $request,
                    'Khuôn mặt không khớp với ảnh CCCD. Vui lòng dùng đúng CCCD của hành khách và chụp lại; tháo kính nếu bị phản sáng.'
                );
            }

            $fingerprint = EnsureBookingFaceVerified::fingerprint(
                $passenger,
                $relativePath
            );

            if (!$fingerprint) {
                return $this->verificationFailure(
                    $request,
                    'Không xác nhận được dữ liệu ảnh. Vui lòng thực hiện lại.'
                );
            }

            $oldFaceImage = session('booking.face_image');

            session([
                'booking.face_image' => $relativePath,
                'booking.face_status' => 'verified',
                'booking.face_verification_hash' => $fingerprint,
            ]);

            $verified = true;

            if ($oldFaceImage && $oldFaceImage !== $relativePath) {
                $oldPath = EnsureBookingFaceVerified::imagePath(
                    $oldFaceImage,
                    'uploads/faces'
                );

                if ($oldPath) {
                    File::delete($oldPath);
                }
            }

            $message = 'Khuôn mặt khớp với CCCD. Xác thực thành công! Bạn có thể tiếp tục đặt vé.';

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'matched' => true,
                    'message' => $message,
                ]);
            }

            return redirect()
                ->route('booking.confirm')
                ->with('success', $message);
        } catch (\Throwable $exception) {
            report($exception);

            return $this->verificationFailure(
                $request,
                'Đối chiếu khuôn mặt chưa hoàn tất. Vui lòng thử lại và kiểm tra Python nếu lỗi tiếp tục.'
            );
        } finally {
            if (!$verified && is_file($fullPath)) {
                File::delete($fullPath);
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

        $response = $route ? redirect()->route($route) : back();

        return $response->with('error', $message);
    }
}