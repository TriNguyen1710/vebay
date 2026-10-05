<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\FlightSeat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PassengerController extends Controller
{
    public function create()
    {
        $tripType = session('flight_search.trip_type', 'one_way');

        if ($tripType !== 'round_trip') {
            $flightId = session('booking.flight_id');
            $seatId = session('booking.seat_id');

            if (!$flightId || !$seatId) {
                return redirect()
                    ->route('flights.search.form')
                    ->with('error', 'Vui lòng chọn chuyến bay và ghế trước.');
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
                session()->forget('booking');

                return redirect()
                    ->route('flights.search.form')
                    ->with('error', 'Chuyến bay này hiện không thể đặt vé.');
            }

            if ($seat->status !== 'available') {
                session()->forget('booking.seat_id');

                return redirect()
                    ->route('seats.show', $flight->id)
                    ->with('error', 'Ghế đã chọn không còn trống. Vui lòng chọn ghế khác.');
            }

            $passenger = session('booking.passenger', []);

            $user = auth()->user();

            $passenger = array_merge(
                [
                    'full_name' => $user->name ?? '',
                    'date_of_birth' => $user?->date_of_birth
                        ? $user->date_of_birth->format('Y-m-d')
                        : '',
                    'gender' => $user->gender ?? '',
                    'phone' => $user->phone ?? '',
                    'email' => $user->email ?? '',
                ],
                $passenger
            );

            $user = auth()->user();

            $passenger = array_merge(
                [
                    'full_name' => $user->name ?? '',
                    'date_of_birth' => $user?->date_of_birth
                        ? $user->date_of_birth->format('Y-m-d')
                        : '',
                    'gender' => $user->gender ?? '',
                    'phone' => $user->phone ?? '',
                    'email' => $user->email ?? '',
                ],
                $passenger
            );

            $outboundFlight = null;
            $outboundSeat = null;
            $returnFlight = null;
            $returnSeat = null;

            return view(
                'user.thong-tin-hanh-khach',
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
                ->with('error', 'Vui lòng chọn đầy đủ chuyến đi, chuyến về và ghế trước.');
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
            session()->forget('booking');

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

        $passenger = session('booking.passenger', []);
        $flight = $outboundFlight;
        $seat = $outboundSeat;

        return view(
            'user.thong-tin-hanh-khach',
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
        $tripType = session('flight_search.trip_type', 'one_way');

        if ($tripType !== 'round_trip') {
            $flightId = session('booking.flight_id');
            $seatId = session('booking.seat_id');

            if (!$flightId || !$seatId) {
                return redirect()
                    ->route('flights.search.form')
                    ->with('error', 'Vui lòng chọn chuyến bay và ghế trước.');
            }

            $flight = Flight::find($flightId);

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
                    ->with('error', 'Ghế này vừa được người khác đặt. Vui lòng chọn ghế khác.');
            }
        } else {
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
                    ->with('error', 'Vui lòng chọn đầy đủ chuyến đi, chuyến về và ghế trước.');
            }

            $outboundFlight = Flight::find($outboundFlightId);

            $outboundSeat = FlightSeat::where('id', $outboundSeatId)
                ->where('flight_id', $outboundFlightId)
                ->first();

            $returnFlight = Flight::find($returnFlightId);

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
                    ->with('error', 'Ghế chiều đi vừa được người khác đặt. Vui lòng chọn ghế khác.');
            }

            if ($returnSeat->status !== 'available') {
                session()->forget('booking.return.seat_id');

                return redirect()
                    ->route('seats.show', [
                        'flight' => $returnFlight->id,
                        'leg' => 'return',
                    ])
                    ->with('error', 'Ghế chiều về vừa được người khác đặt. Vui lòng chọn ghế khác.');
            }
        }

        $validated = $request->validate(
            [
                'full_name' => ['required', 'string', 'max:255'],
                'date_of_birth' => ['required', 'date', 'before:today'],
                'gender' => ['required', 'in:nam,nu,khac'],
                'identity_number' => ['required', 'string', 'max:30'],
                'phone' => ['required', 'string', 'max:20'],
                'email' => ['required', 'email', 'max:255'],
                'cccd_image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            ],
            [
                'full_name.required' => 'Vui lòng nhập họ tên hành khách.',
                'full_name.string' => 'Họ tên hành khách không hợp lệ.',
                'full_name.max' => 'Họ tên không được vượt quá 255 ký tự.',
                'date_of_birth.required' => 'Vui lòng chọn ngày sinh.',
                'date_of_birth.date' => 'Ngày sinh không hợp lệ.',
                'date_of_birth.before' => 'Ngày sinh phải trước ngày hiện tại.',
                'gender.required' => 'Vui lòng chọn giới tính.',
                'gender.in' => 'Giới tính không hợp lệ.',
                'identity_number.required' => 'Vui lòng nhập CCCD hoặc hộ chiếu.',
                'identity_number.max' => 'CCCD hoặc hộ chiếu không hợp lệ.',
                'phone.required' => 'Vui lòng nhập số điện thoại.',
                'phone.max' => 'Số điện thoại không hợp lệ.',
                'email.required' => 'Vui lòng nhập email.',
                'email.email' => 'Email không đúng định dạng.',
                'email.max' => 'Email không hợp lệ.',
                'cccd_image.required' => 'Vui lòng tải lên hình ảnh CCCD.',
                'cccd_image.image' => 'Tệp CCCD phải là hình ảnh.',
                'cccd_image.mimes' => 'Ảnh CCCD chỉ hỗ trợ JPG, JPEG, PNG hoặc WEBP.',
                'cccd_image.max' => 'Ảnh CCCD không được vượt quá 5MB.',
            ]
        );

        $oldCccdImage = session('booking.passenger.cccd_image');

        if ($oldCccdImage) {
            $oldPath = public_path($oldCccdImage);

            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }
        }

        $directory = public_path('uploads/cccd');

        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $file = $request->file('cccd_image');

        $fileName = 'cccd_' . auth()->id() . '_' . now()->format('YmdHis') . '_' . Str::lower(Str::random(8)) . '.' . $file->getClientOriginalExtension();

        $file->move($directory, $fileName);

        $cccdImagePath = 'uploads/cccd/' . $fileName;

        session([
            'booking.passenger' => [
                'full_name' => $validated['full_name'],
                'date_of_birth' => $validated['date_of_birth'],
                'gender' => $validated['gender'],
                'identity_number' => $validated['identity_number'],
                'phone' => $validated['phone'],
                'email' => $validated['email'],
                'cccd_image' => $cccdImagePath,
            ],
        ]);

        session()->forget('booking.face_status');

        return redirect()->route('baggage.create');
    }

    public function confirm()
    {
        $tripType = session('flight_search.trip_type', 'one_way');
        $passenger = session('booking.passenger');
        $faceStatus = session('booking.face_status');

        if (!$passenger) {
            return redirect()
                ->route('passenger.create')
                ->with('error', 'Vui lòng nhập thông tin hành khách.');
        }

        if (empty($passenger['cccd_image'])) {
            return redirect()
                ->route('passenger.create')
                ->with('error', 'Vui lòng tải lên hình ảnh CCCD.');
        }

        if (!$faceStatus) {
            return redirect()
                ->route('face.create')
                ->with('error', 'Vui lòng hoàn thành bước khuôn mặt trước.');
        }

        if ($tripType !== 'round_trip') {
            $flightId = session('booking.flight_id');
            $seatId = session('booking.seat_id');

            if (!$flightId || !$seatId) {
                return redirect()
                    ->route('flights.search.form')
                    ->with('error', 'Thông tin đặt vé chưa đầy đủ.');
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
                'user.xac-nhan-dat-ve',
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
            'user.xac-nhan-dat-ve',
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
}