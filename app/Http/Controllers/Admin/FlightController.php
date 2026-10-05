<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aircraft;
use App\Models\Airport;
use App\Models\Flight;
use App\Models\FlightSeat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FlightController extends Controller
{
    public function index()
    {
        $flights = Flight::with([
            'aircraft',
            'departureAirport',
            'arrivalAirport',
            'flightSeats',
        ])
            ->orderByDesc('flight_date')
            ->orderBy('departure_time')
            ->get();

        return view('admin.flights.index', compact('flights'));
    }

    public function create()
    {
        $airports = Airport::where('status', 1)
            ->orderBy('city')
            ->get();

        $aircraft = Aircraft::where('status', 1)
            ->orderBy('code')
            ->get();

        return view('admin.flights.create', compact('airports', 'aircraft'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'flight_code' => 'required|string|max:50|unique:flights,flight_code',
            'aircraft_id' => 'required|exists:aircraft,id',
            'departure_airport_id' => 'required|exists:airports,id|different:arrival_airport_id',
            'arrival_airport_id' => 'required|exists:airports,id|different:departure_airport_id',
            'flight_date' => 'required|date',
            'departure_time' => 'required',
            'arrival_time' => 'required',
            'price' => 'required|numeric|min:0',
            'vip_surcharge' => 'required|numeric|min:0',
            'status' => 'required|in:open,closed,cancelled,completed',
        ], [
            'flight_code.required' => 'Vui lòng nhập mã chuyến bay.',
            'flight_code.unique' => 'Mã chuyến bay đã tồn tại.',

            'aircraft_id.required' => 'Vui lòng chọn máy bay.',
            'aircraft_id.exists' => 'Máy bay không tồn tại.',

            'departure_airport_id.required' => 'Vui lòng chọn sân bay đi.',
            'departure_airport_id.different' => 'Sân bay đi và sân bay đến phải khác nhau.',

            'arrival_airport_id.required' => 'Vui lòng chọn sân bay đến.',
            'arrival_airport_id.different' => 'Sân bay đến và sân bay đi phải khác nhau.',

            'flight_date.required' => 'Vui lòng chọn ngày bay.',

            'departure_time.required' => 'Vui lòng nhập giờ khởi hành.',
            'arrival_time.required' => 'Vui lòng nhập giờ đến.',

            'price.required' => 'Vui lòng nhập giá vé Phổ thông.',
            'price.numeric' => 'Giá vé Phổ thông phải là số.',
            'price.min' => 'Giá vé Phổ thông không được nhỏ hơn 0.',

            'vip_surcharge.required' => 'Vui lòng nhập phụ thu VIP.',
            'vip_surcharge.numeric' => 'Phụ thu VIP phải là số.',
            'vip_surcharge.min' => 'Phụ thu VIP không được nhỏ hơn 0.',

            'status.required' => 'Vui lòng chọn trạng thái chuyến bay.',
        ]);

        DB::transaction(function () use ($validated) {

            $flight = Flight::create($validated);

            $this->generateSeats($flight);
        });

        return redirect()
            ->route('admin.flights.index')
            ->with('success', 'Thêm chuyến bay thành công.');
    }

    public function edit(Flight $flight)
    {
        $airports = Airport::where('status', 1)
            ->orderBy('city')
            ->get();

        $aircraft = Aircraft::where('status', 1)
            ->orderBy('code')
            ->get();

        return view('admin.flights.edit', compact(
            'flight',
            'airports',
            'aircraft'
        ));
    }

    public function update(Request $request, Flight $flight)
    {
        $validated = $request->validate([
            'flight_code' => 'required|string|max:50|unique:flights,flight_code,' . $flight->id,
            'aircraft_id' => 'required|exists:aircraft,id',
            'departure_airport_id' => 'required|exists:airports,id|different:arrival_airport_id',
            'arrival_airport_id' => 'required|exists:airports,id|different:departure_airport_id',
            'flight_date' => 'required|date',
            'departure_time' => 'required',
            'arrival_time' => 'required',
            'price' => 'required|numeric|min:0',
            'vip_surcharge' => 'required|numeric|min:0',
            'status' => 'required|in:open,closed,cancelled,completed',
        ], [
            'flight_code.required' => 'Vui lòng nhập mã chuyến bay.',
            'flight_code.unique' => 'Mã chuyến bay đã tồn tại.',

            'aircraft_id.required' => 'Vui lòng chọn máy bay.',

            'departure_airport_id.required' => 'Vui lòng chọn sân bay đi.',
            'departure_airport_id.different' => 'Sân bay đi và sân bay đến phải khác nhau.',

            'arrival_airport_id.required' => 'Vui lòng chọn sân bay đến.',
            'arrival_airport_id.different' => 'Sân bay đến và sân bay đi phải khác nhau.',

            'flight_date.required' => 'Vui lòng chọn ngày bay.',

            'departure_time.required' => 'Vui lòng nhập giờ khởi hành.',
            'arrival_time.required' => 'Vui lòng nhập giờ đến.',

            'price.required' => 'Vui lòng nhập giá vé Phổ thông.',
            'price.numeric' => 'Giá vé Phổ thông phải là số.',

            'vip_surcharge.required' => 'Vui lòng nhập phụ thu VIP.',
            'vip_surcharge.numeric' => 'Phụ thu VIP phải là số.',

            'status.required' => 'Vui lòng chọn trạng thái chuyến bay.',
        ]);

        $oldAircraftId = $flight->aircraft_id;

        $hasBookedSeats = $flight->flightSeats()
            ->where('status', 'booked')
            ->exists();

        if (
            $oldAircraftId != $validated['aircraft_id']
            && $hasBookedSeats
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'aircraft_id' => 'Không thể đổi máy bay vì chuyến bay đã có ghế được đặt.',
                ]);
        }

        DB::transaction(function () use (
            $flight,
            $validated,
            $oldAircraftId
        ) {

            $flight->update($validated);

            if ($oldAircraftId != $flight->aircraft_id) {

                $flight->flightSeats()->delete();

                $this->generateSeats($flight);
            }
        });

        return redirect()
            ->route('admin.flights.index')
            ->with('success', 'Cập nhật chuyến bay thành công.');
    }

    public function destroy(Flight $flight)
    {
        $hasBookedSeats = $flight->flightSeats()
            ->where('status', 'booked')
            ->exists();

        if ($hasBookedSeats) {
            return back()->with(
                'error',
                'Không thể xóa chuyến bay vì đã có ghế được đặt.'
            );
        }

        $flight->delete();

        return redirect()
            ->route('admin.flights.index')
            ->with('success', 'Xóa chuyến bay thành công.');
    }

    private function generateSeats(Flight $flight)
    {
        $flight->load('aircraft');

        $rows = $flight->aircraft->rows;
        $seatsPerRow = $flight->aircraft->seats_per_row;

        $seatLetters = range('A', 'Z');

        for ($row = 1; $row <= $rows; $row++) {

            for ($seatIndex = 0; $seatIndex < $seatsPerRow; $seatIndex++) {

                $seatLetter = $seatLetters[$seatIndex];

                $seatNumber = $row . $seatLetter;

                /*
                 * Xác định vị trí ghế
                 */
                if (
                    $seatIndex === 0
                    || $seatIndex === $seatsPerRow - 1
                ) {
                    $seatType = 'window';
                } elseif (
                    $seatsPerRow === 6
                    && ($seatIndex === 2 || $seatIndex === 3)
                ) {
                    $seatType = 'aisle';
                } else {
                    $seatType = 'middle';
                }

                /*
                 * Phân hạng ghế
                 *
                 * Hàng 1 - 3: VIP
                 * Hàng 4 trở đi: Phổ thông
                 */
                $seatClass = $row <= 3
                    ? 'vip'
                    : 'economy';

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