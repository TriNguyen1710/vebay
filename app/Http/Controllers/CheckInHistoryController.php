<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckInHistoryController extends Controller
{
    public function admin(Request $request)
    {
        abort_unless(
            $request->user()->role === 'admin',
            403
        );

        return $this->history($request, true);
    }

    public function employee(Request $request)
    {
        abort_unless(
            $request->user()->role === 'nhanvien',
            403
        );

        return $this->history($request, false);
    }

    private function history(
        Request $request,
        bool $isAdmin
    ) {
        $validated = $request->validate([
            'date' => [
                'nullable',
                'date_format:Y-m-d',
            ],
            'employee_id' => [
                'nullable',
                'integer',
                'exists:users,id',
            ],
            'method' => [
                'nullable',
                'in:face,manual',
            ],
            'flight_id' => [
                'nullable',
                'integer',
                'exists:flights,id',
            ],
        ]);

        // Mặc định hôm nay. Xóa ngày để xem tất cả.
        $date = $request->query->has('date')
            ? ($validated['date'] ?? '')
            : now('Asia/Ho_Chi_Minh')->toDateString();

        $employeeId = $isAdmin
            ? ($validated['employee_id'] ?? '')
            : '';

        $method = $validated['method'] ?? '';
        $flightId = $validated['flight_id'] ?? '';

        $query = DB::table('ticket_check_ins');

        if (!$isAdmin) {
            // Luôn giới hạn theo nhân viên đang đăng nhập.
            $query->where(
                'employee_id',
                $request->user()->id
            );
        } elseif ($employeeId !== '') {
            $query->where(
                'employee_id',
                $employeeId
            );
        }

        if ($date !== '') {
            $start = Carbon::createFromFormat(
                '!Y-m-d',
                $date,
                'Asia/Ho_Chi_Minh'
            );

            $end = $start->copy()->addDay();

            $query
                ->where(
                    'checked_in_at',
                    '>=',
                    $start
                        ->copy()
                        ->timezone(config('app.timezone'))
                )
                ->where(
                    'checked_in_at',
                    '<',
                    $end->timezone(config('app.timezone'))
                );
        }

        if ($method !== '') {
            $query->where(
                'verification_method',
                $method
            );
        }

        if ($flightId !== '') {
            $query->whereIn(
                'ticket_id',
                DB::table('tickets')
                    ->where('flight_id', $flightId)
                    ->select('id')
            );
        }

        $summary = (clone $query)
            ->select(
                'employee_id',
                'employee_name'
            )
            ->selectRaw('COUNT(*) AS total')
            ->selectRaw(
                "SUM(CASE WHEN verification_method = 'face' THEN 1 ELSE 0 END) AS face_total"
            )
            ->selectRaw(
                "SUM(CASE WHEN verification_method = 'manual' THEN 1 ELSE 0 END) AS manual_total"
            )
            ->groupBy(
                'employee_id',
                'employee_name'
            )
            ->orderBy('employee_name')
            ->get();

        $records = $query
            ->orderByDesc('checked_in_at')
            ->orderByDesc('id')
            ->paginate(20)
            ->withQueryString();

        // Ngày giờ đặt vé lấy từ đơn đặt vé.
        $bookingTimes = DB::table('bookings')
            ->whereIn(
                'id',
                $records->getCollection()
                    ->pluck('booking_id')
                    ->filter()
                    ->unique()
                    ->all()
            )
            ->pluck('created_at', 'id');

        // Lấy thông tin chuyến bay và máy bay cho trang hiện tại.
        $tickets = Ticket::with([
                'flight.departureAirport',
                'flight.arrivalAirport',
                'flight.aircraft',
            ])
            ->whereIn(
                'id',
                $records->getCollection()
                    ->pluck('ticket_id')
                    ->filter()
                    ->unique()
                    ->all()
            )
            ->get()
            ->keyBy('id');

        $employees = $isAdmin
            ? User::where('role', 'nhanvien')
                ->orWhereIn(
                    'id',
                    DB::table('ticket_check_ins')
                        ->select('employee_id')
                )
                ->orderBy('name')
                ->get(['id', 'name'])
            : collect();

        $flights = Flight::with([
                'departureAirport',
                'arrivalAirport',
            ])
            ->orderByDesc('flight_date')
            ->orderBy('departure_time')
            ->get();

        return view(
            'check-in.lich-su',
            compact(
                'isAdmin',
                'date',
                'employeeId',
                'method',
                'flightId',
                'summary',
                'records',
                'employees',
                'flights',
                'bookingTimes',
                'tickets'
            )
        );
    }
}