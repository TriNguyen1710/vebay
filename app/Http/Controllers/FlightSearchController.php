<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Models\Flight;
use Illuminate\Http\Request;

class FlightSearchController extends Controller
{
    /**
     * Hiển thị form tìm chuyến bay.
     */
    public function index()
    {
        $airports = Airport::where('status', 1)
            ->orderBy('city')
            ->get();

        return view(
            'user.tim-chuyen-bay',
            compact('airports')
        );
    }


    /**
     * Xử lý tìm chuyến bay một chiều / khứ hồi.
     */
    public function search(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDATE
        |--------------------------------------------------------------------------
        */

        $request->validate(
            [
                'trip_type' => [
                    'required',
                    'in:one_way,round_trip',
                ],

                'departure_airport_id' => [
                    'required',
                    'exists:airports,id',
                ],

                'arrival_airport_id' => [
                    'required',
                    'exists:airports,id',
                    'different:departure_airport_id',
                ],

                'flight_date' => [
                    'required',
                    'date',
                ],

                'return_date' => [
                    'nullable',
                    'required_if:trip_type,round_trip',
                    'date',
                    'after_or_equal:flight_date',
                ],
            ],
            [
                'trip_type.required'
                    => 'Vui lòng chọn loại hành trình.',

                'trip_type.in'
                    => 'Loại hành trình không hợp lệ.',

                'departure_airport_id.required'
                    => 'Vui lòng chọn sân bay đi.',

                'departure_airport_id.exists'
                    => 'Sân bay đi không hợp lệ.',

                'arrival_airport_id.required'
                    => 'Vui lòng chọn sân bay đến.',

                'arrival_airport_id.exists'
                    => 'Sân bay đến không hợp lệ.',

                'arrival_airport_id.different'
                    => 'Sân bay đến phải khác sân bay đi.',

                'flight_date.required'
                    => 'Vui lòng chọn ngày đi.',

                'flight_date.date'
                    => 'Ngày đi không hợp lệ.',

                'return_date.required_if'
                    => 'Vui lòng chọn ngày về khi đặt vé khứ hồi.',

                'return_date.date'
                    => 'Ngày về không hợp lệ.',

                'return_date.after_or_equal'
                    => 'Ngày về phải bằng hoặc sau ngày đi.',
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | LOẠI HÀNH TRÌNH
        |--------------------------------------------------------------------------
        */

        $tripType = $request->trip_type;


        /*
        |--------------------------------------------------------------------------
        | CHUYẾN ĐI
        |--------------------------------------------------------------------------
        */

        $outboundFlights = Flight::with([
            'aircraft',
            'departureAirport',
            'arrivalAirport',
            'flightSeats',
        ])
            ->where(
                'departure_airport_id',
                $request->departure_airport_id
            )
            ->where(
                'arrival_airport_id',
                $request->arrival_airport_id
            )
            ->whereDate(
                'flight_date',
                $request->flight_date
            )
            ->where(
                'status',
                'open'
            )
            ->orderBy(
                'departure_time'
            )
            ->get();


        /*
        |--------------------------------------------------------------------------
        | CHUYẾN VỀ
        |--------------------------------------------------------------------------
        */

        $returnFlights = collect();

        if ($tripType === 'round_trip') {

            $returnFlights = Flight::with([
                'aircraft',
                'departureAirport',
                'arrivalAirport',
                'flightSeats',
            ])
                ->where(
                    'departure_airport_id',
                    $request->arrival_airport_id
                )
                ->where(
                    'arrival_airport_id',
                    $request->departure_airport_id
                )
                ->whereDate(
                    'flight_date',
                    $request->return_date
                )
                ->where(
                    'status',
                    'open'
                )
                ->orderBy(
                    'departure_time'
                )
                ->get();
        }


        /*
        |--------------------------------------------------------------------------
        | LƯU THÔNG TIN TÌM KIẾM
        |--------------------------------------------------------------------------
        */

        session([
            'flight_search.trip_type'
                => $tripType,

            'flight_search.departure_airport_id'
                => $request->departure_airport_id,

            'flight_search.arrival_airport_id'
                => $request->arrival_airport_id,

            'flight_search.flight_date'
                => $request->flight_date,

            'flight_search.return_date'
                => $tripType === 'round_trip'
                    ? $request->return_date
                    : null,
        ]);


        /*
        |--------------------------------------------------------------------------
        | TRẢ KẾT QUẢ
        |--------------------------------------------------------------------------
        */

        return view(
            'user.ket-qua-chuyen-bay',
            [
                'tripType'
                    => $tripType,

                'outboundFlights'
                    => $outboundFlights,

                'returnFlights'
                    => $returnFlights,

                /*
                |--------------------------------------------------------------------------
                | GIỮ BIẾN CŨ
                |--------------------------------------------------------------------------
                |
                | Biến $flights vẫn được truyền để tránh làm hỏng
                | view cũ nếu hiện tại view đang dùng $flights.
                |
                */

                'flights'
                    => $outboundFlights,

                'flightDate'
                    => $request->flight_date,

                'returnDate'
                    => $request->return_date,
            ]
        );
    }
}