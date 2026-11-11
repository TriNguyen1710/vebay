<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\FlightSeat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeatSelectionController extends Controller
{
    private function passengerCount(): int
    {
        return max(
            1,
            min(
                5,
                (int) session(
                    'flight_search.passenger_count',
                    1
                )
            )
        );
    }

    private function tripLeg(?string $requestedLeg): array
    {
        $tripType = session(
            'flight_search.trip_type',
            'one_way'
        );

        $leg = $tripType === 'round_trip'
            ? (
                in_array(
                    $requestedLeg,
                    ['outbound', 'return'],
                    true
                )
                    ? $requestedLeg
                    : 'outbound'
            )
            : 'one_way';

        return [$tripType, $leg];
    }

    private function validTripFlight(
        Flight $flight,
        string $tripType,
        string $leg
    ): bool {
        if ($tripType !== 'round_trip') {
            return true;
        }

        $departure = (int) session(
            'flight_search.departure_airport_id'
        );

        $arrival = (int) session(
            'flight_search.arrival_airport_id'
        );

        $date = $leg === 'return'
            ? session('flight_search.return_date')
            : session('flight_search.flight_date');

        if (!$departure || !$arrival || !$date) {
            return false;
        }

        return (int) $flight->departure_airport_id
                === ($leg === 'return' ? $arrival : $departure)
            && (int) $flight->arrival_airport_id
                === ($leg === 'return' ? $departure : $arrival)
            && $flight->flight_date->format('Y-m-d') === $date;
    }

    /**
     * Hiển thị sơ đồ ghế của chặng đang chọn.
     */
    public function show(Request $request, Flight $flight)
    {
        $flight->load([
            'aircraft',
            'departureAirport',
            'arrivalAirport',
        ]);

        if ($flight->status !== 'open') {
            return redirect()
                ->route('flights.search.form')
                ->with(
                    'error',
                    'Chuyến bay hiện không mở bán.'
                );
        }

        [$tripType, $leg] = $this->tripLeg(
            $request->query('leg')
        );

        if (!$this->validTripFlight(
            $flight,
            $tripType,
            $leg
        )) {
            return redirect()
                ->route('flights.search.form')
                ->with(
                    'error',
                    'Chuyến bay không thuộc hành trình đã tìm kiếm.'
                );
        }

        $passengerCount = $this->passengerCount();

        $seats = $flight->flightSeats()
            ->get()
            ->sortBy(function ($seat) {
                preg_match(
                    '/(\d+)([A-Z]+)/',
                    $seat->seat_number,
                    $matches
                );

                return sprintf(
                    '%05d-%s',
                    (int) ($matches[1] ?? 0),
                    $matches[2] ?? ''
                );
            });

        $totalSeats = $seats->count();

        $bookedSeats = $seats
            ->where('status', 'booked')
            ->count();

        $availableSeats = $seats
            ->where('status', 'available')
            ->count();

        if ($availableSeats < $passengerCount) {
            return redirect()
                ->route('flights.search.form')
                ->with(
                    'error',
                    "Chuyến bay chỉ còn {$availableSeats} ghế, không đủ {$passengerCount} vé bạn đã chọn."
                );
        }

        $economyPrice = (float) $flight->price;

        $vipPrice = $economyPrice
            + (float) $flight->vip_surcharge;

        return view(
            'user.chon-ghe',
            compact(
                'flight',
                'seats',
                'totalSeats',
                'bookedSeats',
                'availableSeats',
                'economyPrice',
                'vipPrice',
                'tripType',
                'leg',
                'passengerCount'
            )
        );
    }

    /**
     * Kiểm tra và lưu chính xác 1–5 ghế được chọn.
     */
    public function select(Request $request, Flight $flight)
    {
        $passengerCount = $this->passengerCount();

        $validated = $request->validate(
            [
                'seat_ids' => [
                    'required',
                    'array',
                    'size:' . $passengerCount,
                ],

                'seat_ids.*' => [
                    'required',
                    'integer',
                    'distinct',
                ],

                'leg' => [
                    'nullable',
                    'in:one_way,outbound,return',
                ],
            ],
            [
                'seat_ids.required'
                    => 'Vui lòng chọn đủ số ghế.',

                'seat_ids.array'
                    => 'Danh sách ghế không hợp lệ.',

                'seat_ids.size'
                    => "Vui lòng chọn đúng {$passengerCount} ghế.",

                'seat_ids.*.integer'
                    => 'Mã ghế không hợp lệ.',

                'seat_ids.*.distinct'
                    => 'Không được chọn trùng ghế.',
            ]
        );

        if ($flight->status !== 'open') {
            return redirect()
                ->route('flights.search.form')
                ->with(
                    'error',
                    'Chuyến bay hiện không mở bán.'
                );
        }

        [$tripType, $leg] = $this->tripLeg(
            $validated['leg'] ?? null
        );

        if (
            $tripType === 'round_trip'
            && ($validated['leg'] ?? null) !== $leg
        ) {
            return back()->with(
                'error',
                'Chặng bay không hợp lệ.'
            );
        }

        if (!$this->validTripFlight(
            $flight,
            $tripType,
            $leg
        )) {
            return redirect()
                ->route('flights.search.form')
                ->with(
                    'error',
                    'Chuyến bay không thuộc hành trình đã tìm kiếm.'
                );
        }

        $selectedIds = array_map(
            'intval',
            $validated['seat_ids']
        );

        $selectedSeats = FlightSeat::where(
            'flight_id',
            $flight->id
        )
            ->whereIn('id', $selectedIds)
            ->where('status', 'available')
            ->get();

        if ($selectedSeats->count() !== $passengerCount) {
            return back()->with(
                'error',
                'Có ghế không tồn tại hoặc đã được đặt. Vui lòng chọn lại.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | GIỮ THỨ TỰ GHẾ ĐƯỢC CHỌN
        |--------------------------------------------------------------------------
        */

        $seatsById = $selectedSeats->keyBy('id');

        $orderedSeats = collect($selectedIds)
            ->map(fn ($id) => $seatsById[$id]);

        $firstSeat = $orderedSeats->first();

        /*
        |--------------------------------------------------------------------------
        | ĐẶT VÉ MỘT CHIỀU
        |--------------------------------------------------------------------------
        */

        if ($tripType !== 'round_trip') {
            session([
                'booking.flight_id'
                    => $flight->id,

                'booking.seat_ids'
                    => $selectedIds,

                /*
                 * Giữ biến cũ cho luồng đặt 1 vé.
                 */
                'booking.seat_id'
                    => $firstSeat->id,
            ]);

            if (!Auth::check()) {
                return back()->with(
                    'error',
                    'Bạn cần đăng nhập để tiếp tục nhập thông tin hành khách.'
                );
            }

            return redirect()
                ->route('passenger.create');
        }

        /*
        |--------------------------------------------------------------------------
        | ĐẶT VÉ KHỨ HỒI
        |--------------------------------------------------------------------------
        */

        if ($leg === 'outbound') {
            session([
                'booking.outbound.flight_id'
                    => $flight->id,

                'booking.outbound.seat_ids'
                    => $selectedIds,

                'booking.outbound.seat_id'
                    => $firstSeat->id,
            ]);

            /*
             * Xóa chiều về cũ nếu chọn lại chiều đi.
             */
            session()->forget([
                'booking.return.flight_id',
                'booking.return.seat_id',
                'booking.return.seat_ids',
            ]);

            $departureAirportId = session(
                'flight_search.departure_airport_id'
            );

            $arrivalAirportId = session(
                'flight_search.arrival_airport_id'
            );

            $returnDate = session(
                'flight_search.return_date'
            );

            if (
                !$departureAirportId
                || !$arrivalAirportId
                || !$returnDate
            ) {
                return redirect()
                    ->route('flights.search.form')
                    ->with(
                        'error',
                        'Thông tin chuyến khứ hồi không còn hợp lệ. Vui lòng tìm lại chuyến bay.'
                    );
            }

            $returnFlights = Flight::with([
                'aircraft',
                'departureAirport',
                'arrivalAirport',
                'flightSeats',
            ])
                ->where(
                    'departure_airport_id',
                    $arrivalAirportId
                )
                ->where(
                    'arrival_airport_id',
                    $departureAirportId
                )
                ->whereDate(
                    'flight_date',
                    $returnDate
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
             * Giữ biến $seat để tương thích
             * với giao diện chọn chuyến về cũ.
             */
            $seat = $firstSeat;

            return view(
                'user.chon-chuyen-ve',
                compact(
                    'flight',
                    'seat',
                    'returnFlights',
                    'returnDate',
                    'passengerCount'
                )
            );
        }

        /*
        |--------------------------------------------------------------------------
        | KIỂM TRA GHẾ CHIỀU ĐI TRƯỚC KHI CHỌN CHIỀU VỀ
        |--------------------------------------------------------------------------
        */

        $outboundIds = session(
            'booking.outbound.seat_ids',
            []
        );

        if (
            !session('booking.outbound.flight_id')
            || count($outboundIds) !== $passengerCount
        ) {
            return redirect()
                ->route('flights.search.form')
                ->with(
                    'error',
                    'Vui lòng chọn đủ ghế chiều đi trước.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | LƯU DANH SÁCH GHẾ CHIỀU VỀ
        |--------------------------------------------------------------------------
        */

        session([
            'booking.return.flight_id'
                => $flight->id,

            'booking.return.seat_ids'
                => $selectedIds,

            'booking.return.seat_id'
                => $firstSeat->id,
        ]);

        if (!Auth::check()) {
            return back()->with(
                'error',
                'Bạn cần đăng nhập để tiếp tục nhập thông tin hành khách.'
            );
        }

        return redirect()
            ->route('passenger.create');
    }
}
