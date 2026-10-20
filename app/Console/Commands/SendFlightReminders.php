<?php

namespace App\Console\Commands;

use App\Models\Notification;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendFlightReminders extends Command
{
    protected $signature = 'flights:send-reminders';

    protected $description = 'Tự động gửi thông báo nhắc khách hàng trước chuyến bay 1 ngày';

    public function handle()
    {
        $tomorrow = Carbon::tomorrow()->toDateString();

        $tickets = Ticket::with([
            'booking',
            'flight.departureAirport',
            'flight.arrivalAirport',
        ])
            ->where('ticket_status', 'active')
            ->whereHas('booking', function ($query) {
                $query->where('payment_status', 'paid');
            })
            ->whereHas('flight', function ($query) use ($tomorrow) {
                $query->whereDate('flight_date', $tomorrow);
            })
            ->get();

        $sentCount = 0;

        foreach ($tickets as $ticket) {
            if (
                !$ticket->booking
                ||
                !$ticket->booking->user_id
                ||
                !$ticket->flight
            ) {
                continue;
            }

            $alreadySent = Notification::where(
                'user_id',
                $ticket->booking->user_id
            )
                ->where(
                    'ticket_id',
                    $ticket->id
                )
                ->where(
                    'title',
                    'Nhắc nhở chuyến bay'
                )
                ->exists();

            if ($alreadySent) {
                continue;
            }

            $departureCode =
                $ticket->flight->departureAirport->code
                ?? '---';

            $arrivalCode =
                $ticket->flight->arrivalAirport->code
                ?? '---';

            $flightDate = Carbon::parse(
                $ticket->flight->flight_date
            )->format('d/m/Y');

            $departureTime = Carbon::parse(
                $ticket->flight->departure_time
            )->format('H:i');

            Notification::create([
                'user_id' => $ticket->booking->user_id,
                'ticket_id' => $ticket->id,
                'sender_id' => null,

                'title' => 'Nhắc nhở chuyến bay',

                'message' =>
                    'Chuyến bay '
                    . $ticket->flight->flight_code
                    . ' từ '
                    . $departureCode
                    . ' đến '
                    . $arrivalCode
                    . ' của bạn sẽ khởi hành vào ngày '
                    . $flightDate
                    . ' lúc '
                    . $departureTime
                    . '. Vui lòng có mặt tại sân bay đúng giờ.',

                'status' => 'unread',
            ]);

            $sentCount++;
        }

        $this->info(
            'Đã gửi '
            . $sentCount
            . ' thông báo nhắc chuyến bay.'
        );

        return Command::SUCCESS;
    }
}