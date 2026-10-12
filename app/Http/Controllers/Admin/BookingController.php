<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Flight;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Ticket::query()
            ->with([
                'booking.user',
                'flight.departureAirport',
                'flight.arrivalAirport',
                'flightSeat',
            ]);

        if ($request->filled('keyword')) {
            $keyword = trim($request->keyword);

            $query->where(function ($q) use ($keyword) {
                $q->where(
                    'ticket_code',
                    'like',
                    '%' . $keyword . '%'
                )
                ->orWhere(
                    'passenger_name',
                    'like',
                    '%' . $keyword . '%'
                )
                ->orWhereHas(
                    'booking',
                    function ($bookingQuery) use ($keyword) {
                        $bookingQuery->where(
                            'booking_code',
                            'like',
                            '%' . $keyword . '%'
                        );
                    }
                )
                ->orWhereHas(
                    'booking.user',
                    function ($userQuery) use ($keyword) {
                        $userQuery
                            ->where(
                                'name',
                                'like',
                                '%' . $keyword . '%'
                            )
                            ->orWhere(
                                'email',
                                'like',
                                '%' . $keyword . '%'
                            );
                    }
                );
            });
        }

        if ($request->filled('payment_status')) {
            $paymentStatus = $request->payment_status;

            $query->whereHas(
                'booking',
                function ($q) use ($paymentStatus) {
                    $q->where(
                        'payment_status',
                        $paymentStatus
                    );
                }
            );
        }

        if ($request->filled('ticket_status')) {
            $query->where(
                'ticket_status',
                $request->ticket_status
            );
        }

        if ($request->filled('seat_class')) {
            $query->where(
                'seat_class',
                $request->seat_class
            );
        }

        if ($request->filled('flight_id')) {
            $query->where(
                'flight_id',
                $request->flight_id
            );
        }

        if ($request->filled('flight_date')) {
            $flightDate = $request->flight_date;

            $query->whereHas(
                'flight',
                function ($q) use ($flightDate) {
                    $q->whereDate(
                        'flight_date',
                        $flightDate
                    );
                }
            );
        }

        $tickets = $query
    ->orderByDesc('created_at')
    ->get();

$activeTickets = $tickets
    ->filter(function ($ticket) {
        return $ticket->ticket_status === 'active'
            && $ticket->booking?->payment_status === 'paid'
            && $ticket->booking?->booking_status === 'confirmed';
    })
    ->values();

$inactiveTickets = $tickets
    ->reject(function ($ticket) {
        return $ticket->ticket_status === 'active'
            && $ticket->booking?->payment_status === 'paid'
            && $ticket->booking?->booking_status === 'confirmed';
    })
    ->values();

        $flights = Flight::with([
            'departureAirport',
            'arrivalAirport',
        ])
            ->orderByDesc('flight_date')
            ->orderBy('departure_time')
            ->get();

                return view(
            'admin.bookings.index',
            compact(
                'tickets',
                'activeTickets',
                'inactiveTickets',
                'flights'
            )
        );
}

public function show(Booking $booking)
{
        $booking->load([
            'user',
            'tickets.flight.departureAirport',
            'tickets.flight.arrivalAirport',
            'tickets.flight.aircraft',
            'tickets.flightSeat',
        ]);

        return view(
            'admin.bookings.show',
            compact('booking')
        );
    }



    public function confirmRefund(
        Booking $booking,
        Ticket $ticket
    ) {
        try {
            DB::transaction(function () use (
                $booking,
                $ticket
            ) {
                $lockedTicket = Ticket::where(
                    'id',
                    $ticket->id
                )
                    ->where(
                        'booking_id',
                        $booking->id
                    )
                    ->lockForUpdate()
                    ->firstOrFail();

                if (
                    $lockedTicket->ticket_status
                    !== 'cancelled'
                ) {
                    throw new \Exception(
                        'Vé này chưa được hủy nên không thể xác nhận hoàn tiền.'
                    );
                }

                if (
                    $lockedTicket->refund_status
                    === 'refunded'
                ) {
                    return;
                }

                if (
                    $lockedTicket->refund_status
                    !== 'waiting_confirmation'
                ) {
                    throw new \Exception(
                        'Vé này chưa có yêu cầu hoàn tiền hợp lệ.'
                    );
                }

                DB::table('tickets')
                    ->where(
                        'id',
                        $lockedTicket->id
                    )
                    ->update([
                        'refund_status' => 'refunded',
                        'refunded_at' => now(),
                        'updated_at' => now(),
                    ]);
            });
        } catch (\Exception $e) {
            return back()->with(
                'error',
                $e->getMessage()
            );
        }

        return redirect()
            ->route(
                'admin.bookings.show',
                $booking->id
            )
            ->with(
                'success',
                'Đã xác nhận hoàn tiền cho khách hàng.'
            );
    }
}