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

        /*
        |--------------------------------------------------------------------------
        | SỐ LƯỢNG HÀNH KHÁCH
        |--------------------------------------------------------------------------
        |
        | Nếu chưa chọn thì mặc định là 1.
        | Cho phép đặt từ 1 đến 5 vé trong một lần.
        |
        */

        $passengerCount = (int) session(
            'flight_search.passenger_count',
            1
        );

        if ($passengerCount < 1 || $passengerCount > 5) {
            $passengerCount = 1;
        }

        return view(
            'user.tim-chuyen-bay',
            compact(
                'airports',
                'passengerCount'
            )
        );
    }

    /**
     * Xử lý tìm chuyến bay một chiều / khứ hồi.
     */
    public function search(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | KIỂM TRA DỮ LIỆU NHẬP
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate(
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

                /*
                |--------------------------------------------------------------------------
                | SỐ LƯỢNG VÉ: 1 ĐẾN 5
                |--------------------------------------------------------------------------
                */

                'passenger_count' => [
                    'nullable',
                    'integer',
                    'min:1',
                    'max:5',
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

                'passenger_count.integer'
                    => 'Số lượng hành khách phải là số nguyên.',

                'passenger_count.min'
                    => 'Phải có ít nhất 1 hành khách.',

                'passenger_count.max'
                    => 'Mỗi lần chỉ được đặt tối đa 5 vé.',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | LOẠI HÀNH TRÌNH
        |--------------------------------------------------------------------------
        */

        $tripType = $validated['trip_type'];

        /*
        |--------------------------------------------------------------------------
        | SỐ LƯỢNG HÀNH KHÁCH
        |--------------------------------------------------------------------------
        |
        | Giữ tương thích với form cũ:
        | Nếu form chưa có passenger_count thì mặc định 1.
        |
        */

        $passengerCount = (int) (
            $validated['passenger_count'] ?? 1
        );

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
                $validated['departure_airport_id']
            )
            ->where(
                'arrival_airport_id',
                $validated['arrival_airport_id']
            )
            ->whereDate(
                'flight_date',
                $validated['flight_date']
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
                    $validated['arrival_airport_id']
                )
                ->where(
                    'arrival_airport_id',
                    $validated['departure_airport_id']
                )
                ->whereDate(
                    'flight_date',
                    $validated['return_date']
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
        | ĐẾM GHẾ TRỐNG
        |--------------------------------------------------------------------------
        |
        | Giữ nguyên danh sách chuyến bay hiện tại.
        | Đồng thời tính số ghế trống để bước chọn
        | chuyến bay kiểm tra đủ chỗ cho cả nhóm.
        |
        | Chưa tự động đặt hoặc giữ ghế tại bước này.
        |
        */

        $outboundFlights->each(function ($flight) {
            $flight->available_seats_count = $flight
                ->flightSeats
                ->where('status', 'available')
                ->count();
        });

        $returnFlights->each(function ($flight) {
            $flight->available_seats_count = $flight
                ->flightSeats
                ->where('status', 'available')
                ->count();
        });

        /*
        |--------------------------------------------------------------------------
        | LƯU THÔNG TIN TÌM KIẾM
        |--------------------------------------------------------------------------
        */

        session([
            'flight_search.trip_type'
                => $tripType,

            'flight_search.departure_airport_id'
                => $validated['departure_airport_id'],

            'flight_search.arrival_airport_id'
                => $validated['arrival_airport_id'],

            'flight_search.flight_date'
                => $validated['flight_date'],

            'flight_search.return_date'
                => $tripType === 'round_trip'
                    ? $validated['return_date']
                    : null,

            /*
            |--------------------------------------------------------------------------
            | LƯU SỐ LƯỢNG VÉ
            |--------------------------------------------------------------------------
            */

            'flight_search.passenger_count'
                => $passengerCount,
        ]);

        /*
        |--------------------------------------------------------------------------
        | TRẢ KẾT QUẢ TÌM CHUYẾN BAY
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
                | Giữ biến $flights để không ảnh hưởng
                | giao diện kết quả đang sử dụng.
                |
                */

                'flights'
                    => $outboundFlights,

                'flightDate'
                    => $validated['flight_date'],

                'returnDate'
                    => $tripType === 'round_trip'
                        ? $validated['return_date']
                        : null,

                /*
                |--------------------------------------------------------------------------
                | TRUYỀN SỐ LƯỢNG HÀNH KHÁCH SANG VIEW
                |--------------------------------------------------------------------------
                */

                'passengerCount'
                    => $passengerCount,
            ]
        );
    }
}
