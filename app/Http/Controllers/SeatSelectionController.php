<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\FlightSeat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeatSelectionController extends Controller
{
    /**
     * Hiển thị sơ đồ ghế.
     */
    public function show(
        Request $request,
        Flight $flight
    ) {
        $flight->load([
            'aircraft',
            'departureAirport',
            'arrivalAirport',
        ]);

        if ($flight->status !== 'open') {
            return redirect()
                ->route('flights.search.form')
                ->with(
                    'error',
                    'Chuyến bay hiện không mở bán.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | XÁC ĐỊNH CHẶNG BAY
        |--------------------------------------------------------------------------
        |
        | one_way  : vé một chiều
        | outbound : chiều đi của vé khứ hồi
        | return   : chiều về của vé khứ hồi
        |
        */

        $tripType = session(
            'flight_search.trip_type',
            'one_way'
        );

        $leg = $request->query('leg');

        if ($tripType === 'round_trip') {
            $leg = in_array(
                $leg,
                ['outbound', 'return'],
                true
            )
                ? $leg
                : 'outbound';
        } else {
            $leg = 'one_way';
        }

        /*
        |--------------------------------------------------------------------------
        | KIỂM TRA CHUYẾN BAY CÓ ĐÚNG HÀNH TRÌNH KHÔNG
        |--------------------------------------------------------------------------
        */

        if ($tripType === 'round_trip') {
            $departureAirportId = (int) session(
                'flight_search.departure_airport_id'
            );

            $arrivalAirportId = (int) session(
                'flight_search.arrival_airport_id'
            );

            $flightDate = session(
                'flight_search.flight_date'
            );

            $returnDate = session(
                'flight_search.return_date'
            );

            if ($leg === 'outbound') {
                $validFlight =
                    (int) $flight->departure_airport_id
                        === $departureAirportId
                    &&
                    (int) $flight->arrival_airport_id
                        === $arrivalAirportId
                    &&
                    $flight->flight_date->format('Y-m-d')
                        === $flightDate;
            } else {
                $validFlight =
                    (int) $flight->departure_airport_id
                        === $arrivalAirportId
                    &&
                    (int) $flight->arrival_airport_id
                        === $departureAirportId
                    &&
                    $flight->flight_date->format('Y-m-d')
                        === $returnDate;
            }

            if (!$validFlight) {
                return redirect()
                    ->route('flights.search.form')
                    ->with(
                        'error',
                        'Chuyến bay không thuộc hành trình đã tìm kiếm.'
                    );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | LẤY DANH SÁCH GHẾ
        |--------------------------------------------------------------------------
        */

        $seats = $flight->flightSeats()
            ->get()
            ->sortBy(function ($seat) {
                preg_match(
                    '/(\d+)([A-Z]+)/',
                    $seat->seat_number,
                    $matches
                );

                $row = isset($matches[1])
                    ? (int) $matches[1]
                    : 0;

                $letter = $matches[2] ?? '';

                return sprintf(
                    '%05d-%s',
                    $row,
                    $letter
                );
            });

        $totalSeats = $seats->count();

        $bookedSeats = $seats
            ->where('status', 'booked')
            ->count();

        $availableSeats = $seats
            ->where('status', 'available')
            ->count();

        if ($availableSeats <= 0) {
            return redirect()
                ->route('flights.search.form')
                ->with(
                    'error',
                    'Chuyến bay đã hết ghế.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | GIÁ VÉ
        |--------------------------------------------------------------------------
        */

        $economyPrice = (float) $flight->price;

        $vipPrice =
            (float) $flight->price
            + (float) $flight->vip_surcharge;

        return view(
            'user.chon-ghe',
            compact(
                'flight',
                'seats',
                'totalSeats',
                'bookedSeats',
                'availableSeats',
                'economyPrice',
                'vipPrice',
                'tripType',
                'leg'
            )
        );
    }


    /**
     * Xử lý chọn ghế.
     */
    public function select(
        Request $request,
        Flight $flight
    ) {
        $request->validate(
            [
                'seat_id' => [
                    'required',
                    'integer',
                ],

                'leg' => [
                    'nullable',
                    'in:one_way,outbound,return',
                ],
            ],
            [
                'seat_id.required'
                    => 'Vui lòng chọn ghế.',

                'seat_id.integer'
                    => 'Ghế không hợp lệ.',

                'leg.in'
                    => 'Chặng bay không hợp lệ.',
            ]
        );

        if ($flight->status !== 'open') {
            return redirect()
                ->route('flights.search.form')
                ->with(
                    'error',
                    'Chuyến bay hiện không mở bán.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | KIỂM TRA GHẾ
        |--------------------------------------------------------------------------
        */

        $seat = FlightSeat::where(
            'id',
            $request->seat_id
        )
            ->where(
                'flight_id',
                $flight->id
            )
            ->first();

        if (!$seat) {
            return back()
                ->with(
                    'error',
                    'Ghế không tồn tại.'
                );
        }

        if ($seat->status !== 'available') {
            return back()
                ->with(
                    'error',
                    'Ghế này đã được đặt. Vui lòng chọn ghế khác.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | XÁC ĐỊNH LOẠI HÀNH TRÌNH
        |--------------------------------------------------------------------------
        */

        $tripType = session(
            'flight_search.trip_type',
            'one_way'
        );

        /*
        |--------------------------------------------------------------------------
        | MỘT CHIỀU
        |--------------------------------------------------------------------------
        |
        | Giữ nguyên session cũ để không ảnh hưởng
        | luồng đặt vé một chiều đang hoạt động.
        |
        */

        if ($tripType !== 'round_trip') {
            session([
                'booking.flight_id'
                    => $flight->id,

                'booking.seat_id'
                    => $seat->id,
            ]);

            if (!Auth::check()) {
                return back()
                    ->with(
                        'error',
                        'Bạn cần đăng nhập để tiếp tục nhập thông tin hành khách.'
                    );
            }

            return redirect()
                ->route('passenger.create');
        }

        /*
        |--------------------------------------------------------------------------
        | KHỨ HỒI
        |--------------------------------------------------------------------------
        */

        $leg = $request->input(
            'leg',
            'outbound'
        );

        if (!in_array(
            $leg,
            ['outbound', 'return'],
            true
        )) {
            return back()
                ->with(
                    'error',
                    'Chặng bay không hợp lệ.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | CHỌN GHẾ CHIỀU ĐI
        |--------------------------------------------------------------------------
        */

        if ($leg === 'outbound') {
            session([
                'booking.outbound.flight_id'
                    => $flight->id,

                'booking.outbound.seat_id'
                    => $seat->id,
            ]);

            /*
            |--------------------------------------------------------------------------
            | XÓA CHIỀU VỀ CŨ NẾU KHÁCH CHỌN LẠI CHIỀU ĐI
            |--------------------------------------------------------------------------
            */

            session()->forget([
                'booking.return.flight_id',
                'booking.return.seat_id',
            ]);

            /*
            |--------------------------------------------------------------------------
            | TÌM CÁC CHUYẾN VỀ
            |--------------------------------------------------------------------------
            */

            $departureAirportId = session(
                'flight_search.departure_airport_id'
            );

            $arrivalAirportId = session(
                'flight_search.arrival_airport_id'
            );

            $returnDate = session(
                'flight_search.return_date'
            );

            if (
                !$departureAirportId
                || !$arrivalAirportId
                || !$returnDate
            ) {
                return redirect()
                    ->route('flights.search.form')
                    ->with(
                        'error',
                        'Thông tin chuyến khứ hồi không còn hợp lệ. Vui lòng tìm lại chuyến bay.'
                    );
            }

            $returnFlights = Flight::with([
                'aircraft',
                'departureAirport',
                'arrivalAirport',
                'flightSeats',
            ])
                ->where(
                    'departure_airport_id',
                    $arrivalAirportId
                )
                ->where(
                    'arrival_airport_id',
                    $departureAirportId
                )
                ->whereDate(
                    'flight_date',
                    $returnDate
                )
                ->where(
                    'status',
                    'open'
                )
                ->orderBy(
                    'departure_time'
                )
                ->get();

            return view(
                'user.chon-chuyen-ve',
                compact(
                    'flight',
                    'seat',
                    'returnFlights',
                    'returnDate'
                )
            );
        }

        /*
        |--------------------------------------------------------------------------
        | CHỌN GHẾ CHIỀU VỀ
        |--------------------------------------------------------------------------
        */

        $outboundFlightId = session(
            'booking.outbound.flight_id'
        );

        $outboundSeatId = session(
            'booking.outbound.seat_id'
        );

        if (
            !$outboundFlightId
            || !$outboundSeatId
        ) {
            return redirect()
                ->route('flights.search.form')
                ->with(
                    'error',
                    'Vui lòng chọn chuyến đi trước.'
                );
        }

        session([
            'booking.return.flight_id'
                => $flight->id,

            'booking.return.seat_id'
                => $seat->id,
        ]);

        if (!Auth::check()) {
            return back()
                ->with(
                    'error',
                    'Bạn cần đăng nhập để tiếp tục nhập thông tin hành khách.'
                );
        }

        return redirect()
            ->route('passenger.create');
    }
}