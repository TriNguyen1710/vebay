<?php

namespace App\Http\Middleware;

use App\Models\Booking;
use App\Models\Ticket;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class RecordTicketCheckIn
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {
        if (!$request->routeIs(
            'nhanvien.tickets.confirm',
            'nhanvien.tickets.confirm.manual'
        )) {
            return $next($request);
        }

        $employee = $request->user();

        if (
            !$employee
            || $employee->role !== 'nhanvien'
        ) {
            return $next($request);
        }

        $ticket = $request->route('ticket');

        abort_unless(
            $ticket instanceof Ticket,
            404
        );

        return DB::transaction(function () use (
            $request,
            $next,
            $employee,
            $ticket
        ) {
            // Khóa booking trước, cùng thứ tự với thanh toán/hủy vé.
            $booking = Booking::whereKey(
                $ticket->booking_id
            )
                ->lockForUpdate()
                ->firstOrFail();

            $locked = Ticket::whereKey(
                $ticket->id
            )
                ->lockForUpdate()
                ->firstOrFail();

            $wasActive = $locked->ticket_status === 'active';

            // Controller nhận bản vé mới nhất sau khi khóa.
            $request->route()->setParameter(
                'ticket',
                $locked
            );

            // Giữ nguyên kiểm tra khuôn mặt/CCCD và đường dẫn quay lại.
            $response = $next($request);

            $locked->refresh();

            if (
                !$wasActive
                || $locked->ticket_status !== 'used'
            ) {
                return $response;
            }

            abort_unless(
                $booking->payment_status === 'paid',
                409
            );

            $locked->load([
                'flight',
                'flightSeat',
            ]);

            $time = now();

            $method = $request->routeIs(
                'nhanvien.tickets.confirm.manual'
            )
                ? 'manual'
                : 'face';

            DB::table('ticket_check_ins')->insert([
                'ticket_id' => $locked->id,

                'booking_id' => $booking->id,

                'employee_id' => $employee->id,

                'ticket_code' => $locked->ticket_code,

                'booking_code' => $booking->booking_code,

                'passenger_name' => $locked->passenger_name,

                'employee_name' => $employee->name,

                'flight_code' =>
                    $locked->flight?->flight_code ?? '---',

                'seat_number' =>
                    $locked->flightSeat?->seat_number,

                'verification_method' => $method,

                'checked_in_at' => $time,

                'created_at' => $time,

                'updated_at' => $time,
            ]);

            $message = $request->session()->get(
                'success',
                'Check-in thành công.'
            );

            $request->session()->flash(
                'success',
                $message
                . ' Thời gian: '
                . $time
                    ->copy()
                    ->timezone('Asia/Ho_Chi_Minh')
                    ->format('d/m/Y H:i:s')
                . '. Nhân viên: '
                . $employee->name
                . '.'
            );

            return $response;
        });
    }
}