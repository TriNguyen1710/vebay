<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\FlightSeat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class FaceController extends Controller
{
    public function create()
    {
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
        $passenger = session('booking.passenger');

        if (!$passenger) {
            return redirect()
                ->route('passenger.create')
                ->with('error', 'Thông tin hành khách chưa đầy đủ.');
        }

        $request->validate(
            [
                'face_image' => ['required', 'string'],
            ],
            [
                'face_image.required' => 'Vui lòng chụp khuôn mặt trước khi tiếp tục.',
                'face_image.string' => 'Dữ liệu khuôn mặt không hợp lệ.',
            ]
        );

        $imageData = $request->input('face_image');

        if (!preg_match('/^data:image\/(jpeg|jpg|png|webp);base64,/', $imageData, $matches)) {
            return back()->with('error', 'Ảnh khuôn mặt không hợp lệ. Vui lòng chụp lại.');
        }

        $base64Data = substr($imageData, strpos($imageData, ',') + 1);
        $decodedImage = base64_decode($base64Data, true);

        if ($decodedImage === false) {
            return back()->with('error', 'Không thể xử lý ảnh khuôn mặt. Vui lòng chụp lại.');
        }

        if (strlen($decodedImage) > 5 * 1024 * 1024) {
            return back()->with('error', 'Ảnh khuôn mặt vượt quá dung lượng cho phép.');
        }

        $oldFaceImage = session('booking.face_image');

        if ($oldFaceImage) {
            $oldPath = public_path($oldFaceImage);

            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }
        }

        $directory = public_path('uploads/faces');

        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $extension = strtolower($matches[1]);

        if ($extension === 'jpg') {
            $extension = 'jpeg';
        }

        $fileExtension = $extension === 'jpeg' ? 'jpg' : $extension;

        $fileName = 'face_' . auth()->id() . '_' . now()->format('YmdHis') . '_' . Str::lower(Str::random(8)) . '.' . $fileExtension;
        $relativePath = 'uploads/faces/' . $fileName;
        $fullPath = public_path($relativePath);

        if (File::put($fullPath, $decodedImage) === false) {
            return back()->with('error', 'Không thể lưu ảnh khuôn mặt. Vui lòng thử lại.');
        }

        session([
            'booking.face_image' => $relativePath,
            'booking.face_status' => 'captured',
        ]);

        return redirect()->route('booking.confirm');
    }
}
