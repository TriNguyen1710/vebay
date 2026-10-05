<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Flight;
use App\Models\FlightSeat;
use App\Models\Payment;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    private const HOLD_MINUTES = 15;
    private const CHANGE_FEE = 100000;

    public function myTickets()
    {
        $expiredBookings = Booking::where('user_id', auth()->id())
            ->where('payment_status', 'unpaid')
            ->where('booking_status', 'pending')
            ->whereNotNull('expires_at')
            ->where('expires_at', '<=', now())
            ->pluck('id');

        foreach ($expiredBookings as $bookingId) {
            $this->cancelExpiredBookingById($bookingId);
        }

        $bookings = Booking::where('user_id', auth()->id())
            ->with([
                'tickets.flight.departureAirport',
                'tickets.flight.arrivalAirport',
                'tickets.flightSeat',
            ])
            ->orderByDesc('created_at')
            ->get();

        return view('user.ve-cua-toi', compact('bookings'));
    }

    public function store(Request $request)
    {
        $tripType = session('flight_search.trip_type', 'one_way');
        $passenger = session('booking.passenger');
        $faceStatus = session('booking.face_status');
        $faceImage = session('booking.face_image');

        if (
            !$passenger
            || !$faceStatus
            || !$faceImage
            || empty($passenger['cccd_image'])
        ) {
            return redirect()
                ->route('flights.search.form')
                ->with(
                    'error',
                    'Thông tin đặt vé không đầy đủ. Vui lòng thực hiện lại.'
                );
        }

        if ($tripType !== 'round_trip') {
            $flightId = session('booking.flight_id');
            $seatId = session('booking.seat_id');
            $baggage = session('baggage');

            if (!$flightId || !$seatId) {
                return redirect()
                    ->route('flights.search.form')
                    ->with(
                        'error',
                        'Thông tin chuyến bay hoặc ghế chưa đầy đủ.'
                    );
            }

            if (!is_array($baggage)) {
                return redirect()
                    ->route('baggage.create')
                    ->with(
                        'error',
                        'Vui lòng chọn hành lý trước khi tiếp tục.'
                    );
            }

            $baggageWeight = (int) ($baggage['weight'] ?? 0);
            $baggagePrice = (float) ($baggage['price'] ?? 0);

            try {
                $booking = DB::transaction(
                    function () use (
                        $flightId,
                        $seatId,
                        $passenger,
                        $faceImage,
                        $baggageWeight,
                        $baggagePrice
                    ) {
                        $flight = Flight::where('id', $flightId)
                            ->where('status', 'open')
                            ->first();

                        if (!$flight) {
                            throw new \Exception(
                                'Chuyến bay không còn mở bán.'
                            );
                        }

                        $seat = FlightSeat::where('id', $seatId)
                            ->where('flight_id', $flight->id)
                            ->lockForUpdate()
                            ->first();

                        if (!$seat) {
                            throw new \Exception(
                                'Ghế không tồn tại.'
                            );
                        }

                        if ($seat->status !== 'available') {
                            throw new \Exception(
                                'Ghế đã được người khác đặt. Vui lòng chọn ghế khác.'
                            );
                        }

                        $ticketPrice = $this->calculateTicketPrice(
                            $flight,
                            $seat
                        );

                        $totalAmount =
                            $ticketPrice
                            + $baggagePrice;

                        $booking = Booking::create([
                            'user_id' => auth()->id(),
                            'booking_code' => $this->generateBookingCode(),
                            'total_amount' => $totalAmount,
                            'booking_status' => 'pending',
                            'payment_status' => 'unpaid',
                            'expires_at' => now()->addMinutes(
                                self::HOLD_MINUTES
                            ),
                        ]);

                        $this->createTicket(
                            $booking,
                            $flight,
                            $seat,
                            $passenger,
                            $ticketPrice,
                            $faceImage,
                            $baggageWeight,
                            $baggagePrice
                        );

                        $seat->update([
                            'status' => 'booked',
                        ]);

                        return $booking;
                    }
                );

                session()->forget([
                    'booking',
                    'baggage',
                ]);

                return redirect()
                    ->route(
                        'payment.show',
                        $booking->id
                    );
            } catch (\Exception $e) {
                return redirect()
                    ->route('flights.search.form')
                    ->with(
                        'error',
                        $e->getMessage()
                    );
            }
        }

        $outboundFlightId = session(
            'booking.outbound.flight_id'
        );

        $outboundSeatId = session(
            'booking.outbound.seat_id'
        );

        $returnFlightId = session(
            'booking.return.flight_id'
        );

        $returnSeatId = session(
            'booking.return.seat_id'
        );

        $outboundBaggage = session(
            'baggage.outbound'
        );

        $returnBaggage = session(
            'baggage.return'
        );

        if (
            !$outboundFlightId
            || !$outboundSeatId
            || !$returnFlightId
            || !$returnSeatId
        ) {
            return redirect()
                ->route('flights.search.form')
                ->with(
                    'error',
                    'Thông tin đặt vé khứ hồi chưa đầy đủ.'
                );
        }

        if (
            !is_array($outboundBaggage)
            || !is_array($returnBaggage)
        ) {
            return redirect()
                ->route('baggage.create')
                ->with(
                    'error',
                    'Vui lòng chọn hành lý cho chiều đi và chiều về.'
                );
        }

        $outboundBaggageWeight = (int) (
            $outboundBaggage['weight'] ?? 0
        );

        $outboundBaggagePrice = (float) (
            $outboundBaggage['price'] ?? 0
        );

        $returnBaggageWeight = (int) (
            $returnBaggage['weight'] ?? 0
        );

        $returnBaggagePrice = (float) (
            $returnBaggage['price'] ?? 0
        );

        try {
            $booking = DB::transaction(
                function () use (
                    $outboundFlightId,
                    $outboundSeatId,
                    $returnFlightId,
                    $returnSeatId,
                    $passenger,
                    $faceImage,
                    $outboundBaggageWeight,
                    $outboundBaggagePrice,
                    $returnBaggageWeight,
                    $returnBaggagePrice
                ) {
                    $outboundFlight = Flight::where(
                        'id',
                        $outboundFlightId
                    )
                        ->where('status', 'open')
                        ->first();

                    if (!$outboundFlight) {
                        throw new \Exception(
                            'Chuyến bay chiều đi không còn mở bán.'
                        );
                    }

                    $returnFlight = Flight::where(
                        'id',
                        $returnFlightId
                    )
                        ->where('status', 'open')
                        ->first();

                    if (!$returnFlight) {
                        throw new \Exception(
                            'Chuyến bay chiều về không còn mở bán.'
                        );
                    }

                    $outboundSeat = FlightSeat::where(
                        'id',
                        $outboundSeatId
                    )
                        ->where(
                            'flight_id',
                            $outboundFlight->id
                        )
                        ->lockForUpdate()
                        ->first();

                    if (
                        !$outboundSeat
                        || $outboundSeat->status
                            !== 'available'
                    ) {
                        throw new \Exception(
                            'Ghế chiều đi không còn khả dụng.'
                        );
                    }

                    $returnSeat = FlightSeat::where(
                        'id',
                        $returnSeatId
                    )
                        ->where(
                            'flight_id',
                            $returnFlight->id
                        )
                        ->lockForUpdate()
                        ->first();

                    if (
                        !$returnSeat
                        || $returnSeat->status
                            !== 'available'
                    ) {
                        throw new \Exception(
                            'Ghế chiều về không còn khả dụng.'
                        );
                    }

                    $outboundPrice =
                        $this->calculateTicketPrice(
                            $outboundFlight,
                            $outboundSeat
                        );

                    $returnPrice =
                        $this->calculateTicketPrice(
                            $returnFlight,
                            $returnSeat
                        );

                    $totalAmount =
                        $outboundPrice
                        + $returnPrice
                        + $outboundBaggagePrice
                        + $returnBaggagePrice;

                    $booking = Booking::create([
                        'user_id' => auth()->id(),
                        'booking_code' =>
                            $this->generateBookingCode(),
                        'total_amount' =>
                            $totalAmount,
                        'booking_status' =>
                            'pending',
                        'payment_status' =>
                            'unpaid',
                        'expires_at' =>
                            now()->addMinutes(
                                self::HOLD_MINUTES
                            ),
                    ]);

                    $this->createTicket(
                        $booking,
                        $outboundFlight,
                        $outboundSeat,
                        $passenger,
                        $outboundPrice,
                        $faceImage,
                        $outboundBaggageWeight,
                        $outboundBaggagePrice
                    );

                    $this->createTicket(
                        $booking,
                        $returnFlight,
                        $returnSeat,
                        $passenger,
                        $returnPrice,
                        $faceImage,
                        $returnBaggageWeight,
                        $returnBaggagePrice
                    );

                    $outboundSeat->update([
                        'status' => 'booked',
                    ]);

                    $returnSeat->update([
                        'status' => 'booked',
                    ]);

                    return $booking;
                }
            );

            session()->forget([
                'booking',
                'baggage',
            ]);

            return redirect()
                ->route(
                    'payment.show',
                    $booking->id
                );
        } catch (\Exception $e) {
            return redirect()
                ->route('flights.search.form')
                ->with(
                    'error',
                    $e->getMessage()
                );
        }
    }

    public function payment(Booking $booking)
    {
        if (
            $booking->user_id
            !== auth()->id()
        ) {
            abort(403);
        }

        if (
            $booking->payment_status === 'paid'
            && $booking->booking_status === 'confirmed'
        ) {
            return redirect()
                ->route(
                    'ticket.show',
                    $booking->id
                );
        }

        if (
            $booking->payment_status === 'paid'
            && $booking->booking_status === 'pending'
        ) {
            return view(
                'user.thanh-toan',
                compact('booking')
            );
        }

        if (
            $booking->booking_status
            === 'cancelled'
        ) {
            return redirect()
                ->route('flights.search.form')
                ->with(
                    'error',
                    'Đơn đặt vé này đã bị hủy. Vui lòng đặt vé lại.'
                );
        }

        if (
            $this->isBookingExpired(
                $booking
            )
        ) {
            $this->cancelExpiredBookingById(
                $booking->id
            );

            return redirect()
                ->route('flights.search.form')
                ->with(
                    'error',
                    'Thời gian giữ ghế 15 phút đã hết. Ghế đã được giải phóng, vui lòng đặt vé lại.'
                );
        }

        $booking->load([
            'tickets.flight.departureAirport',
            'tickets.flight.arrivalAirport',
            'tickets.flight.aircraft',
            'tickets.flightSeat',
        ]);

        return view(
            'user.thanh-toan',
            compact('booking')
        );
    }

    public function pay(Booking $booking)
    {
        if (
            $booking->user_id
            !== auth()->id()
        ) {
            abort(403);
        }

        try {
            DB::transaction(
                function () use ($booking) {
                    $lockedBooking =
                        Booking::where(
                            'id',
                            $booking->id
                        )
                            ->lockForUpdate()
                            ->firstOrFail();

                    if (
                        $lockedBooking->payment_status
                        === 'paid'
                    ) {
                        return;
                    }

                    if (
                        $lockedBooking->booking_status
                        === 'cancelled'
                    ) {
                        throw new \Exception(
                            'Đơn đặt vé đã bị hủy.'
                        );
                    }

                    if (
                        $this->isBookingExpired(
                            $lockedBooking
                        )
                    ) {
                        $tickets =
                            Ticket::where(
                                'booking_id',
                                $lockedBooking->id
                            )
                                ->lockForUpdate()
                                ->get();

                        foreach (
                            $tickets
                            as $ticket
                        ) {
                            FlightSeat::where(
                                'id',
                                $ticket->flight_seat_id
                            )
                                ->lockForUpdate()
                                ->update([
                                    'status' =>
                                        'available',
                                ]);
                        }

                        Ticket::where(
                            'booking_id',
                            $lockedBooking->id
                        )->update([
                            'ticket_status' =>
                                'cancelled',
                        ]);

                        $lockedBooking->update([
                            'booking_status' =>
                                'cancelled',
                        ]);

                        throw new \Exception(
                            'Thời gian giữ ghế 15 phút đã hết. Ghế đã được giải phóng.'
                        );
                    }

                    $lockedBooking->update([
                        'payment_status' =>
                            'paid',
                        'booking_status' =>
                            'pending',
                        'expires_at' =>
                            null,
                    ]);

                    Payment::firstOrCreate(
                        [
                            'booking_id' =>
                                $lockedBooking->id,
                        ],
                        [
                            'payment_code' =>
                                'PAY' . Str::upper(
                                    Str::random(10)
                                ),
                            'amount' =>
                                $lockedBooking->total_amount,
                            'payment_method' =>
                                'bank_transfer',
                            'payment_status' =>
                                'paid',
                            'paid_at' =>
                                now(),
                        ]
                    );
                }
            );
        } catch (\Exception $e) {
            $freshBooking = Booking::find(
                $booking->id
            );

            if (
                $freshBooking
                && $freshBooking->payment_status
                    === 'unpaid'
                && $this->isBookingExpired(
                    $freshBooking
                )
            ) {
                $this->cancelExpiredBookingById(
                    $freshBooking->id
                );

                return redirect()
                    ->route(
                        'flights.search.form'
                    )
                    ->with(
                        'error',
                        'Thời gian giữ ghế 15 phút đã hết. Ghế đã được giải phóng, vui lòng đặt vé lại.'
                    );
            }

            return redirect()
                ->route(
                    'payment.show',
                    $booking->id
                )
                ->with(
                    'error',
                    $e->getMessage()
                );
        }

        return redirect()
            ->route(
                'payment.show',
                $booking->id
            )
            ->with(
                'success',
                'Thanh toán thành công. Vé đang chờ Admin xác nhận.'
            );
    }

    public function ticket(Booking $booking)
    {
        if (
            $booking->user_id
            !== auth()->id()
        ) {
            abort(403);
        }

        if (
            $booking->payment_status !== 'paid'
            || $booking->booking_status !== 'confirmed'
        ) {
            if (
                $this->isBookingExpired(
                    $booking
                )
            ) {
                $this->cancelExpiredBookingById(
                    $booking->id
                );

                return redirect()
                    ->route(
                        'flights.search.form'
                    )
                    ->with(
                        'error',
                        'Đơn đặt vé đã hết thời gian giữ ghế. Vui lòng đặt vé lại.'
                    );
            }

            return redirect()
                ->route(
                    'payment.show',
                    $booking->id
                )
                ->with(
                    'error',
                    $booking->payment_status === 'paid'
                        ? 'Vé đang chờ Admin xác nhận.'
                        : 'Vui lòng thanh toán trước khi xem vé điện tử.'
                );
        }

        $booking->load([
            'tickets.flight.departureAirport',
            'tickets.flight.arrivalAirport',
            'tickets.flight.aircraft',
            'tickets.flightSeat',
        ]);

        return view(
            'user.ve-dien-tu',
            compact('booking')
        );
    }

    public function changeFlight(Ticket $ticket)
    {
        $this->authorizeTicketChange(
            $ticket
        );

        $ticket->load([
            'booking',
            'flight.departureAirport',
            'flight.arrivalAirport',
            'flightSeat',
        ]);

        $flights = Flight::where(
            'departure_airport_id',
            $ticket->flight->departure_airport_id
        )
            ->where(
                'arrival_airport_id',
                $ticket->flight->arrival_airport_id
            )
            ->where('status', 'open')
            ->where(
                'id',
                '!=',
                $ticket->flight_id
            )
            ->whereDate(
                'flight_date',
                '>=',
                now()->toDateString()
            )
            ->whereHas(
                'flightSeats',
                function ($query) {
                    $query->where(
                        'status',
                        'available'
                    );
                }
            )
            ->with([
                'departureAirport',
                'arrivalAirport',
                'aircraft',
            ])
            ->orderBy('flight_date')
            ->orderBy('departure_time')
            ->get();

        return view(
            'user.doi-chuyen-bay',
            compact(
                'ticket',
                'flights'
            )
        );
    }

    public function changeSeat(
        Ticket $ticket,
        Flight $flight
    ) {
        $this->authorizeTicketChange(
            $ticket
        );

        if (
            $flight->departure_airport_id
                !== $ticket->flight
                    ->departure_airport_id
            || $flight->arrival_airport_id
                !== $ticket->flight
                    ->arrival_airport_id
            || $flight->status
                !== 'open'
            || $flight->id
                === $ticket->flight_id
            || $flight->flight_date
                ->isBefore(
                    now()->startOfDay()
                )
        ) {
            return redirect()
                ->route(
                    'ticket.change.flight',
                    $ticket->id
                )
                ->with(
                    'error',
                    'Chuyến bay mới không hợp lệ.'
                );
        }

        $ticket->load([
            'booking',
            'flight.departureAirport',
            'flight.arrivalAirport',
            'flightSeat',
        ]);

        $flight->load([
            'departureAirport',
            'arrivalAirport',
            'aircraft',
            'flightSeats' =>
                function ($query) {
                    $query
                        ->where(
                            'status',
                            'available'
                        )
                        ->orderBy(
                            'seat_number'
                        );
                },
        ]);

        return view(
            'user.doi-chon-ghe',
            compact(
                'ticket',
                'flight'
            )
        );
    }

    public function changeConfirm(
        Request $request,
        Ticket $ticket
    ) {
        $this->authorizeTicketChange(
            $ticket
        );

        $validated =
            $request->validate(
                [
                    'flight_id' => [
                        'required',
                        'integer',
                        'exists:flights,id',
                    ],
                    'seat_id' => [
                        'required',
                        'integer',
                        'exists:flight_seats,id',
                    ],
                ],
                [
                    'flight_id.required' =>
                        'Vui lòng chọn chuyến bay mới.',
                    'seat_id.required' =>
                        'Vui lòng chọn ghế mới.',
                ]
            );

        $flight = Flight::where(
            'id',
            $validated['flight_id']
        )
            ->where('status', 'open')
            ->firstOrFail();

        $seat = FlightSeat::where(
            'id',
            $validated['seat_id']
        )
            ->where(
                'flight_id',
                $flight->id
            )
            ->where(
                'status',
                'available'
            )
            ->first();

        if (!$seat) {
            return back()
                ->with(
                    'error',
                    'Ghế vừa chọn không còn trống. Vui lòng chọn ghế khác.'
                );
        }

        if (
            $flight->departure_airport_id
                !== $ticket->flight
                    ->departure_airport_id
            || $flight->arrival_airport_id
                !== $ticket->flight
                    ->arrival_airport_id
            || $flight->id
                === $ticket->flight_id
        ) {
            return redirect()
                ->route(
                    'ticket.change.flight',
                    $ticket->id
                )
                ->with(
                    'error',
                    'Chuyến bay mới không hợp lệ.'
                );
        }

        $newPrice =
            $this->calculateTicketPrice(
                $flight,
                $seat
            );

        $fareDifference = max(
            0,
            $newPrice
                - (float) $ticket->price
        );

        $amountToPay =
            self::CHANGE_FEE
            + $fareDifference;

        session([
            'ticket_change' => [
                'ticket_id' =>
                    $ticket->id,
                'flight_id' =>
                    $flight->id,
                'seat_id' =>
                    $seat->id,
                'old_price' =>
                    (float) $ticket->price,
                'new_price' =>
                    $newPrice,
                'fare_difference' =>
                    $fareDifference,
                'change_fee' =>
                    self::CHANGE_FEE,
                'amount_to_pay' =>
                    $amountToPay,
            ],
        ]);

        $ticket->load([
            'booking',
            'flight.departureAirport',
            'flight.arrivalAirport',
            'flightSeat',
        ]);

        $flight->load([
            'departureAirport',
            'arrivalAirport',
        ]);

        return view(
            'user.doi-thanh-toan',
            compact(
                'ticket',
                'flight',
                'seat',
                'newPrice',
                'fareDifference',
                'amountToPay'
            )
        );
    }

    public function changePay(
        Request $request,
        Ticket $ticket
    ) {
        $this->authorizeTicketChange(
            $ticket
        );

        $change = session(
            'ticket_change'
        );

        if (
            !$change
            || (int) $change['ticket_id']
                !== $ticket->id
        ) {
            return redirect()
                ->route(
                    'ticket.change.flight',
                    $ticket->id
                )
                ->with(
                    'error',
                    'Phiên đổi vé không còn hợp lệ. Vui lòng chọn lại chuyến bay.'
                );
        }

        try {
            DB::transaction(
                function () use (
                    $ticket,
                    $change
                ) {
                    $lockedTicket =
                        Ticket::where(
                            'id',
                            $ticket->id
                        )
                            ->lockForUpdate()
                            ->firstOrFail();

                    $booking =
                        Booking::where(
                            'id',
                            $lockedTicket
                                ->booking_id
                        )
                            ->lockForUpdate()
                            ->firstOrFail();

                    if (
                        $booking->user_id
                            !== auth()->id()
                        || $booking
                            ->payment_status
                            !== 'paid'
                        || $lockedTicket
                            ->ticket_status
                            !== 'active'
                    ) {
                        throw new \Exception(
                            'Vé không còn đủ điều kiện để đổi chuyến.'
                        );
                    }

                    $newFlight =
                        Flight::where(
                            'id',
                            $change[
                                'flight_id'
                            ]
                        )
                            ->where(
                                'status',
                                'open'
                            )
                            ->first();

                    if (!$newFlight) {
                        throw new \Exception(
                            'Chuyến bay mới không còn mở bán.'
                        );
                    }

                    $newSeat =
                        FlightSeat::where(
                            'id',
                            $change[
                                'seat_id'
                            ]
                        )
                            ->where(
                                'flight_id',
                                $newFlight->id
                            )
                            ->lockForUpdate()
                            ->first();

                    if (
                        !$newSeat
                        || $newSeat->status
                            !== 'available'
                    ) {
                        throw new \Exception(
                            'Ghế mới đã được người khác đặt. Vui lòng chọn ghế khác.'
                        );
                    }

                    $oldSeat =
                        FlightSeat::where(
                            'id',
                            $lockedTicket
                                ->flight_seat_id
                        )
                            ->lockForUpdate()
                            ->first();

                    $newPrice =
                        $this->calculateTicketPrice(
                            $newFlight,
                            $newSeat
                        );

                    $fareDifference = max(
                        0,
                        $newPrice
                            - (float)
                                $lockedTicket
                                    ->price
                    );

                    $amountToPay =
                        self::CHANGE_FEE
                        + $fareDifference;

                    if (
                        (float) $amountToPay
                        !== (float)
                            $change[
                                'amount_to_pay'
                            ]
                    ) {
                        throw new \Exception(
                            'Giá chuyến bay đã thay đổi. Vui lòng thực hiện đổi vé lại.'
                        );
                    }

                    $newSeat->update([
                        'status' => 'booked',
                    ]);

                    $oldPrice =
                        (float)
                            $lockedTicket
                                ->price;

                    $lockedTicket->update([
                        'flight_id' =>
                            $newFlight->id,
                        'flight_seat_id' =>
                            $newSeat->id,
                        'seat_class' =>
                            $newSeat
                                ->seat_class,
                        'price' =>
                            $newPrice,
                    ]);

                    if ($oldSeat) {
                        $oldSeat->update([
                            'status' =>
                                'available',
                        ]);
                    }

                    $booking->update([
                        'total_amount' => max(
                            0,
                            (float)
                                $booking
                                    ->total_amount
                            - $oldPrice
                            + $newPrice
                            + self::CHANGE_FEE
                        ),
                    ]);
                }
            );
        } catch (\Exception $e) {
            return redirect()
                ->route(
                    'ticket.change.flight',
                    $ticket->id
                )
                ->with(
                    'error',
                    $e->getMessage()
                );
        }

        session()->forget(
            'ticket_change'
        );

        return redirect()
            ->route('tickets.mine')
            ->with(
                'success',
                'Đổi chuyến bay thành công. Ghế cũ đã được giải phóng.'
            );
    }

    public function cancelTicket(
        Ticket $ticket
    ) {
        $ticket->load([
            'booking',
            'flight.departureAirport',
            'flight.arrivalAirport',
            'flightSeat',
        ]);

        if (
            $ticket->booking->user_id
            !== auth()->id()
        ) {
            abort(403);
        }

        if (
            $ticket->booking
                ->payment_status
                !== 'paid'
            || $ticket->booking
                ->booking_status
                !== 'confirmed'
            || $ticket->ticket_status
                !== 'active'
        ) {
            return redirect()
                ->route('tickets.mine')
                ->with(
                    'error',
                    'Vé này không đủ điều kiện để hủy.'
                );
        }

        if (
            $ticket->flight
                ->flight_date
                ->isBefore(
                    now()->startOfDay()
                )
        ) {
            return redirect()
                ->route('tickets.mine')
                ->with(
                    'error',
                    'Không thể hủy vé của chuyến bay đã qua ngày khởi hành.'
                );
        }

        $refundPercentage = 60;

        $refundAmount =
            round(
                (float) $ticket->price
                * $refundPercentage
                / 100
            );

        return view(
            'user.huy-ve',
            compact(
                'ticket',
                'refundPercentage',
                'refundAmount'
            )
        );
    }

    public function submitCancellation(
        Request $request,
        Ticket $ticket
    ) {
        $validated =
            $request->validate(
                [
                    'refund_bank_name' => [
                        'required',
                        'string',
                        'max:100',
                    ],
                    'refund_account_number' => [
                        'required',
                        'string',
                        'max:50',
                    ],
                    'refund_account_name' => [
                        'required',
                        'string',
                        'max:100',
                    ],
                ],
                [
                    'refund_bank_name.required' =>
                        'Vui lòng nhập tên ngân hàng.',
                    'refund_account_number.required' =>
                        'Vui lòng nhập số tài khoản.',
                    'refund_account_name.required' =>
                        'Vui lòng nhập tên chủ tài khoản.',
                ]
            );

        try {
            DB::transaction(
                function () use (
                    $ticket,
                    $validated
                ) {
                    $lockedTicket =
                        Ticket::where(
                            'id',
                            $ticket->id
                        )
                            ->lockForUpdate()
                            ->firstOrFail();

                    $booking =
                        Booking::where(
                            'id',
                            $lockedTicket
                                ->booking_id
                        )
                            ->lockForUpdate()
                            ->firstOrFail();

                    if (
                        $booking->user_id
                        !== auth()->id()
                    ) {
                        abort(403);
                    }

                    if (
                        $booking
                            ->payment_status
                            !== 'paid'
                        || $booking
                            ->booking_status
                            !== 'confirmed'
                        || $lockedTicket
                            ->ticket_status
                            !== 'active'
                    ) {
                        throw new \Exception(
                            'Vé này không còn đủ điều kiện để hủy.'
                        );
                    }

                    $flight =
                        Flight::where(
                            'id',
                            $lockedTicket
                                ->flight_id
                        )
                            ->firstOrFail();

                    if (
                        $flight->flight_date
                            ->isBefore(
                                now()->startOfDay()
                            )
                    ) {
                        throw new \Exception(
                            'Không thể hủy vé của chuyến bay đã qua ngày khởi hành.'
                        );
                    }

                    $refundAmount =
                        round(
                            (float)
                                $lockedTicket
                                    ->price
                            * 0.6
                        );

                    FlightSeat::where(
                        'id',
                        $lockedTicket
                            ->flight_seat_id
                    )
                        ->lockForUpdate()
                        ->update([
                            'status' =>
                                'available',
                        ]);

                    Ticket::where(
                        'id',
                        $lockedTicket->id
                    )->update([
                        'ticket_status' =>
                            'cancelled',
                        'refund_amount' =>
                            $refundAmount,
                        'refund_status' =>
                            'waiting_confirmation',
                        'refund_bank_name' =>
                            $validated[
                                'refund_bank_name'
                            ],
                        'refund_account_number' =>
                            $validated[
                                'refund_account_number'
                            ],
                        'refund_account_name' =>
                            $validated[
                                'refund_account_name'
                            ],
                    ]);

                    $remainingActiveTickets =
                        Ticket::where(
                            'booking_id',
                            $booking->id
                        )
                            ->where(
                                'ticket_status',
                                'active'
                            )
                            ->count();

                    if (
                        $remainingActiveTickets
                        === 0
                    ) {
                        $booking->update([
                            'booking_status' =>
                                'cancelled',
                        ]);
                    }
                }
            );
        } catch (\Exception $e) {
            return redirect()
                ->route(
                    'tickets.mine'
                )
                ->with(
                    'error',
                    $e->getMessage()
                );
        }

        return redirect()
            ->route('tickets.mine')
            ->with(
                'success',
                'Hủy vé thành công. Yêu cầu hoàn tiền đã được gửi và đang chờ Admin xác nhận.'
            );
    }

    private function authorizeTicketChange(
        Ticket $ticket
    ): void {
        $ticket->loadMissing([
            'booking',
            'flight',
        ]);

        if (
            $ticket->booking->user_id
            !== auth()->id()
        ) {
            abort(403);
        }

        if (
            $ticket->booking
                ->payment_status
                !== 'paid'
            || $ticket->booking
                ->booking_status
                !== 'confirmed'
            || $ticket->ticket_status
                !== 'active'
        ) {
            abort(
                403,
                'Vé này không đủ điều kiện để đổi chuyến.'
            );
        }

        if (
            $ticket->flight
                ->flight_date
                ->isBefore(
                    now()->startOfDay()
                )
        ) {
            abort(
                403,
                'Không thể đổi chuyến bay đã qua ngày khởi hành.'
            );
        }
    }

    private function isBookingExpired(
        Booking $booking
    ): bool {
        if (
            $booking->payment_status
            === 'paid'
        ) {
            return false;
        }

        if (!$booking->expires_at) {
            return false;
        }

        return $booking
            ->expires_at
            ->isPast();
    }

    private function cancelExpiredBookingById(
        int $bookingId
    ): void {
        DB::transaction(
            function () use (
                $bookingId
            ) {
                $booking =
                    Booking::where(
                        'id',
                        $bookingId
                    )
                        ->lockForUpdate()
                        ->first();

                if (
                    !$booking
                    || $booking
                        ->payment_status
                        === 'paid'
                    || $booking
                        ->booking_status
                        !== 'pending'
                ) {
                    return;
                }

                if (
                    !$this->isBookingExpired(
                        $booking
                    )
                ) {
                    return;
                }

                $tickets =
                    Ticket::where(
                        'booking_id',
                        $booking->id
                    )
                        ->lockForUpdate()
                        ->get();

                foreach (
                    $tickets
                    as $ticket
                ) {
                    FlightSeat::where(
                        'id',
                        $ticket
                            ->flight_seat_id
                    )
                        ->lockForUpdate()
                        ->update([
                            'status' =>
                                'available',
                        ]);
                }

                Ticket::where(
                    'booking_id',
                    $booking->id
                )->update([
                    'ticket_status' =>
                        'cancelled',
                ]);

                $booking->update([
                    'booking_status' =>
                        'cancelled',
                ]);
            }
        );
    }

    private function calculateTicketPrice(
        Flight $flight,
        FlightSeat $seat
    ) {
        if (
            $seat->seat_class
            === 'vip'
        ) {
            return (float)
                $flight->price
                + (float)
                    $flight
                        ->vip_surcharge;
        }

        return (float)
            $flight->price;
    }

    private function createTicket(
        Booking $booking,
        Flight $flight,
        FlightSeat $seat,
        array $passenger,
        float $ticketPrice,
        string $faceImage,
        int $baggageWeight = 0,
        float $baggagePrice = 0
    ) {
        return Ticket::create([
            'booking_id' =>
                $booking->id,
            'flight_id' =>
                $flight->id,
            'flight_seat_id' =>
                $seat->id,
            'seat_class' =>
                $seat->seat_class,
            'ticket_code' =>
                $this->generateTicketCode(),
            'passenger_name' =>
                $passenger['full_name'],
            'date_of_birth' =>
                $passenger['date_of_birth'],
            'gender' =>
                $passenger['gender'],
            'identity_number' =>
                $passenger[
                    'identity_number'
                ],
            'phone' =>
                $passenger['phone'],
            'email' =>
                $passenger['email'],
            'price' =>
                $ticketPrice,
            'baggage_weight' =>
                $baggageWeight,
            'baggage_price' =>
                $baggagePrice,
            'ticket_status' =>
                'pending',
            'face_image' =>
                $faceImage,
            'cccd_image' =>
                $passenger['cccd_image'],
        ]);
    }

    private function generateBookingCode()
    {
        do {
            $code =
                'BK'
                . Str::upper(
                    Str::random(8)
                );
        } while (
            Booking::where(
                'booking_code',
                $code
            )->exists()
        );

        return $code;
    }

    private function generateTicketCode()
    {
        do {
            $code =
                'VE'
                . Str::upper(
                    Str::random(10)
                );
        } while (
            Ticket::where(
                'ticket_code',
                $code
            )->exists()
        );

        return $code;
    }
}