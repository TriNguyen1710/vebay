<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Flight;
use App\Models\Booking;
use App\Models\Ticket;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | THÁNG / NĂM ĐƯỢC CHỌN
        |--------------------------------------------------------------------------
        */

        $selectedMonth = (int) $request->input('month', now()->month);
        $selectedYear = (int) $request->input('year', now()->year);

        // Kiểm tra tháng hợp lệ
        if ($selectedMonth < 1 || $selectedMonth > 12) {
            $selectedMonth = now()->month;
        }

        // Kiểm tra năm hợp lệ
        if ($selectedYear < 2000 || $selectedYear > 2100) {
            $selectedYear = now()->year;
        }


        /*
        |--------------------------------------------------------------------------
        | THỐNG KÊ TỔNG QUAN
        |--------------------------------------------------------------------------
        */

        // Tổng khách hàng
        $totalUsers = User::where('role', 'user')->count();

        // Tổng chuyến bay
        $totalFlights = Flight::count();

        // Tổng đơn đặt vé
        $totalBookings = Booking::count();

        // Tổng số vé
        $totalTickets = Ticket::count();

        // Tổng đơn đã thanh toán
        $paidBookings = Booking::where(
            'payment_status',
            'paid'
        )->count();

        // Tổng doanh thu
        // Chỉ tính đơn đã thanh toán
        $totalRevenue = Booking::where(
            'payment_status',
            'paid'
        )->sum('total_amount');

        // Tổng vé VIP
        $vipTickets = Ticket::where(
            'seat_class',
            'vip'
        )->count();

        // Tổng vé phổ thông
        $economyTickets = Ticket::where(
            'seat_class',
            'economy'
        )->count();


        /*
        |--------------------------------------------------------------------------
        | THỐNG KÊ THEO THÁNG ĐƯỢC CHỌN
        |--------------------------------------------------------------------------
        */

        // Đơn đã thanh toán trong tháng
        $monthlyPaidBookings = Booking::where(
            'payment_status',
            'paid'
        )
            ->whereYear('created_at', $selectedYear)
            ->whereMonth('created_at', $selectedMonth)
            ->count();


        // Doanh thu trong tháng
        $monthlyRevenue = Booking::where(
            'payment_status',
            'paid'
        )
            ->whereYear('created_at', $selectedYear)
            ->whereMonth('created_at', $selectedMonth)
            ->sum('total_amount');


        // Tổng vé tạo trong tháng
        $monthlyTickets = Ticket::whereYear(
            'created_at',
            $selectedYear
        )
            ->whereMonth(
                'created_at',
                $selectedMonth
            )
            ->count();


        // Vé VIP trong tháng
        $monthlyVipTickets = Ticket::where(
            'seat_class',
            'vip'
        )
            ->whereYear('created_at', $selectedYear)
            ->whereMonth('created_at', $selectedMonth)
            ->count();


        // Vé phổ thông trong tháng
        $monthlyEconomyTickets = Ticket::where(
            'seat_class',
            'economy'
        )
            ->whereYear('created_at', $selectedYear)
            ->whereMonth('created_at', $selectedMonth)
            ->count();


        /*
        |--------------------------------------------------------------------------
        | DOANH THU 12 THÁNG
        |--------------------------------------------------------------------------
        */

        $monthlyRevenueChart = [];

        $monthlyTicketChart = [];

        for ($month = 1; $month <= 12; $month++) {

            /*
            |--------------------------------------------------------------------------
            | DOANH THU TỪNG THÁNG
            |--------------------------------------------------------------------------
            */

            $revenue = Booking::where(
                'payment_status',
                'paid'
            )
                ->whereYear(
                    'created_at',
                    $selectedYear
                )
                ->whereMonth(
                    'created_at',
                    $month
                )
                ->sum('total_amount');

            $monthlyRevenueChart[] = (float) $revenue;


            /*
            |--------------------------------------------------------------------------
            | SỐ VÉ TỪNG THÁNG
            |--------------------------------------------------------------------------
            */

            $ticketCount = Ticket::whereYear(
                'created_at',
                $selectedYear
            )
                ->whereMonth(
                    'created_at',
                    $month
                )
                ->count();

            $monthlyTicketChart[] = $ticketCount;
        }


        /*
        |--------------------------------------------------------------------------
        | DANH SÁCH NĂM CHO BỘ LỌC
        |--------------------------------------------------------------------------
        */

        $currentYear = now()->year;

        $years = range(
            $currentYear - 5,
            $currentYear + 1
        );


        /*
        |--------------------------------------------------------------------------
        | TRẢ VỀ VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'admin.statistics.index',
            compact(
                'totalUsers',
                'totalFlights',
                'totalBookings',
                'totalTickets',
                'paidBookings',
                'totalRevenue',

                'vipTickets',
                'economyTickets',

                'selectedMonth',
                'selectedYear',

                'monthlyPaidBookings',
                'monthlyRevenue',
                'monthlyTickets',
                'monthlyVipTickets',
                'monthlyEconomyTickets',

                'monthlyRevenueChart',
                'monthlyTicketChart',

                'years'
            )
        );
    }
}