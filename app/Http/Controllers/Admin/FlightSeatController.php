<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use App\Models\FlightSeat;

class FlightSeatController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HIỂN THỊ SƠ ĐỒ GHẾ
    |--------------------------------------------------------------------------
    */

    public function index(Flight $flight)
    {
        $flight->load([
            'aircraft',
            'departureAirport',
            'arrivalAirport',
        ]);

        /*
        |--------------------------------------------------------------------------
        | NẾU CHƯA CÓ GHẾ THÌ TỰ TẠO
        |--------------------------------------------------------------------------
        */

        $this->createSeatsIfNeeded($flight);


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


        /*
        |--------------------------------------------------------------------------
        | THỐNG KÊ GHẾ
        |--------------------------------------------------------------------------
        */

        $totalSeats = $seats->count();

        $bookedSeats = $seats
            ->where('status', 'booked')
            ->count();

        $availableSeats = $seats
            ->where('status', 'available')
            ->count();

        $vipSeats = $seats
            ->where('seat_class', 'vip')
            ->count();

        $economySeats = $seats
            ->where('seat_class', 'economy')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | HIỂN THỊ GIAO DIỆN
        |--------------------------------------------------------------------------
        */

        return view(
            'admin.flights.seats',
            compact(
                'flight',
                'seats',
                'totalSeats',
                'bookedSeats',
                'availableSeats',
                'vipSeats',
                'economySeats'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | TỰ ĐỘNG TẠO GHẾ
    |--------------------------------------------------------------------------
    */

    private function createSeatsIfNeeded(Flight $flight)
    {
        /*
        |--------------------------------------------------------------------------
        | ĐÃ CÓ GHẾ THÌ KHÔNG TẠO LẠI
        |--------------------------------------------------------------------------
        */

        if ($flight->flightSeats()->exists()) {
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | KIỂM TRA MÁY BAY
        |--------------------------------------------------------------------------
        */

        if (!$flight->aircraft) {
            return;
        }

        $rows = (int) $flight->aircraft->rows;

        $seatsPerRow = (int) $flight->aircraft->seats_per_row;

        $letters = range('A', 'Z');


        /*
        |--------------------------------------------------------------------------
        | TẠO GHẾ THEO SỐ HÀNG VÀ SỐ GHẾ MỖI HÀNG
        |--------------------------------------------------------------------------
        */

        for ($row = 1; $row <= $rows; $row++) {

            for (
                $seatIndex = 0;
                $seatIndex < $seatsPerRow;
                $seatIndex++
            ) {

                $letter = $letters[$seatIndex];

                $seatNumber = $row . $letter;


                /*
                |--------------------------------------------------------------------------
                | XÁC ĐỊNH VỊ TRÍ GHẾ
                |--------------------------------------------------------------------------
                */

                if (
                    $seatIndex === 0
                    ||
                    $seatIndex === $seatsPerRow - 1
                ) {

                    $seatType = 'window';

                } elseif (
                    $seatsPerRow === 6
                    &&
                    (
                        $seatIndex === 2
                        ||
                        $seatIndex === 3
                    )
                ) {

                    $seatType = 'aisle';

                } else {

                    $seatType = 'middle';
                }


                /*
                |--------------------------------------------------------------------------
                | HẠNG GHẾ
                |--------------------------------------------------------------------------
                | Hàng 1 - 3: VIP
                | Hàng 4 trở đi: Phổ thông
                |--------------------------------------------------------------------------
                */

                $seatClass = $row <= 3
                    ? 'vip'
                    : 'economy';


                /*
                |--------------------------------------------------------------------------
                | LƯU GHẾ
                |--------------------------------------------------------------------------
                */

                FlightSeat::create([
                    'flight_id' => $flight->id,
                    'seat_number' => $seatNumber,
                    'seat_type' => $seatType,
                    'seat_class' => $seatClass,
                    'status' => 'available',
                ]);
            }
        }
    }
}