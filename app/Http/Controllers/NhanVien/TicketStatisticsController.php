<?php

namespace App\Http\Controllers\NhanVien;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TicketStatisticsController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'from_date' => ['nullable', 'date'],
            'to_date' => ['nullable', 'date', 'after_or_equal:from_date'],
            'flight_id' => ['nullable', 'integer', 'exists:flights,id'],
        ]);

        $fromDate = $validated['from_date']
            ?? now()->startOfMonth()->toDateString();

        $toDate = $validated['to_date']
            ?? now()->endOfMonth()->toDateString();

        $flightId = $validated['flight_id'] ?? null;

        // Lấy dữ liệu vé theo ngày khởi hành.
        $query = Ticket::query()
            ->join('flights', 'tickets.flight_id', '=', 'flights.id')
            ->join('bookings', 'tickets.booking_id', '=', 'bookings.id')
            ->whereDate('flights.flight_date', '>=', $fromDate)
            ->whereDate('flights.flight_date', '<=', $toDate);

        if ($flightId) {
            $query->where('tickets.flight_id', $flightId);
        }

        // Tất cả vé được tạo trong phạm vi lọc.
        $totalTickets = (clone $query)->count();

        // Vé đã thanh toán và còn hiệu lực.
        $activeTickets = (clone $query)
            ->where('bookings.payment_status', 'paid')
            ->where('tickets.ticket_status', 'active')
            ->count();

        // Vé đã được nhân viên kiểm tra.
        $usedTickets = (clone $query)
            ->where('bookings.payment_status', 'paid')
            ->where('tickets.ticket_status', 'used')
            ->count();

        // Vé đã hủy.
        $cancelledTickets = (clone $query)
            ->where('tickets.ticket_status', 'cancelled')
            ->count();

        // Vé thuộc đơn chưa thanh toán.
        $unpaidTickets = (clone $query)
            ->where('bookings.payment_status', 'unpaid')
            ->count();

        // Tổng số vé thuộc đơn đã thanh toán.
        $paidTickets = (clone $query)
            ->where('bookings.payment_status', 'paid')
            ->count();

        // Tỷ lệ đã kiểm tra trên các vé đang hiệu lực/đã sử dụng.
        $checkinBase = $activeTickets + $usedTickets;

        $checkinRate = $checkinBase > 0
            ? round($usedTickets / $checkinBase * 100, 1)
            : 0;

        // Thống kê số vé đã thanh toán theo ngày bay.
        $dailyStatistics = (clone $query)
            ->where('bookings.payment_status', 'paid')
            ->selectRaw('DATE(flights.flight_date) as flight_day')
            ->selectRaw('COUNT(tickets.id) as total')
            ->selectRaw("
                SUM(
                    CASE WHEN tickets.ticket_status = 'active'
                    THEN 1 ELSE 0 END
                ) as active_count
            ")
            ->selectRaw("
                SUM(
                    CASE WHEN tickets.ticket_status = 'used'
                    THEN 1 ELSE 0 END
                ) as used_count
            ")
            ->groupBy('flight_day')
            ->orderBy('flight_day')
            ->get();

        // Thống kê theo từng chuyến bay.
        $flightStatistics = (clone $query)
            ->select(
                'flights.id',
                'flights.flight_code',
                'flights.flight_date'
            )
            ->selectRaw('COUNT(tickets.id) as total_tickets')
            ->selectRaw("
                SUM(
                    CASE WHEN bookings.payment_status = 'paid'
                    AND tickets.ticket_status = 'active'
                    THEN 1 ELSE 0 END
                ) as active_tickets
            ")
            ->selectRaw("
                SUM(
                    CASE WHEN bookings.payment_status = 'paid'
                    AND tickets.ticket_status = 'used'
                    THEN 1 ELSE 0 END
                ) as used_tickets
            ")
            ->selectRaw("
                SUM(
                    CASE WHEN tickets.ticket_status = 'cancelled'
                    THEN 1 ELSE 0 END
                ) as cancelled_tickets
            ")
            ->groupBy(
                'flights.id',
                'flights.flight_code',
                'flights.flight_date'
            )
            ->orderBy('flights.flight_date')
            ->orderBy('flights.flight_code')
            ->get();

        $flights = Flight::query()
            ->whereDate('flight_date', '>=', $fromDate)
            ->whereDate('flight_date', '<=', $toDate)
            ->orderBy('flight_date')
            ->orderBy('flight_code')
            ->get(['id', 'flight_code', 'flight_date']);

        return view('nhanvien.thong-ke-ve', compact(
            'fromDate',
            'toDate',
            'flightId',
            'flights',
            'totalTickets',
            'activeTickets',
            'usedTickets',
            'cancelledTickets',
            'unpaidTickets',
            'paidTickets',
            'checkinRate',
            'dailyStatistics',
            'flightStatistics'
        ));
    }
}
