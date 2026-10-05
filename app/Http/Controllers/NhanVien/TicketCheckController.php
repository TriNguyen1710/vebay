<?php

namespace App\Http\Controllers\NhanVien;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use App\Models\Notification;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketCheckController extends Controller
{
    public function index()
    {
        $keyword = '';

        $tickets = Ticket::with([
            'booking',
            'flight.departureAirport',
            'flight.arrivalAirport',
            'flight.aircraft',
            'flightSeat',
        ])
            ->whereHas('booking', function ($query) {
                $query->where('payment_status', 'paid');
            })
            ->whereIn('ticket_status', ['active', 'used'])
            ->orderByDesc('created_at')
            ->get();

        return view(
            'nhanvien.tra-cuu-ve',
            compact('tickets', 'keyword')
        );
    }

    public function search(Request $request)
    {
        $keyword = trim(
            (string) $request->input('keyword', '')
        );

        $query = Ticket::with([
            'booking',
            'flight.departureAirport',
            'flight.arrivalAirport',
            'flight.aircraft',
            'flightSeat',
        ])
            ->whereHas('booking', function ($bookingQuery) {
                $bookingQuery->where(
                    'payment_status',
                    'paid'
                );
            })
            ->whereIn('ticket_status', ['active', 'used']);

        if ($keyword !== '') {
            $query->where(function ($subQuery) use ($keyword) {
                $subQuery
                    ->where(
                        'ticket_code',
                        'like',
                        '%' . $keyword . '%'
                    )
                    ->orWhere(
                        'passenger_name',
                        'like',
                        '%' . $keyword . '%'
                    )
                    ->orWhere(
                        'identity_number',
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
                    );
            });
        }

        $tickets = $query
            ->orderByDesc('created_at')
            ->get();

        return view(
            'nhanvien.tra-cuu-ve',
            compact('tickets', 'keyword')
        );
    }

    public function uncheckedPassengers(Request $request)
    {
        $keyword = trim(
            (string) $request->input('keyword', '')
        );

        $flightId = $request->input('flight_id');

        $query = Ticket::with([
            'booking.user',
            'flight.departureAirport',
            'flight.arrivalAirport',
            'flight.aircraft',
            'flightSeat',
        ])
            ->where('ticket_status', 'active')
            ->whereHas('booking', function ($bookingQuery) {
                $bookingQuery->where(
                    'payment_status',
                    'paid'
                );
            });

        if ($keyword !== '') {
            $query->where(function ($subQuery) use ($keyword) {
                $subQuery
                    ->where(
                        'ticket_code',
                        'like',
                        '%' . $keyword . '%'
                    )
                    ->orWhere(
                        'passenger_name',
                        'like',
                        '%' . $keyword . '%'
                    )
                    ->orWhere(
                        'identity_number',
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
                    );
            });
        }

        if ($flightId) {
            $query->where(
                'flight_id',
                $flightId
            );
        }

        $tickets = $query
            ->orderByDesc('created_at')
            ->get();

        $flights = Flight::with([
            'departureAirport',
            'arrivalAirport',
        ])
            ->orderByDesc('flight_date')
            ->get();

        return view(
            'nhanvien.hanh-khach-chua-kiem-tra',
            compact(
                'tickets',
                'flights',
                'keyword',
                'flightId'
            )
        );
    }

    public function remind(Ticket $ticket)
    {
        $ticket->load([
            'booking.user',
            'flight.departureAirport',
            'flight.arrivalAirport',
        ]);

        if (!$ticket->booking) {
            return back()->with(
                'error',
                'Không tìm thấy thông tin đặt vé.'
            );
        }

        if ($ticket->booking->payment_status !== 'paid') {
            return back()->with(
                'error',
                'Vé chưa thanh toán nên không thể gửi nhắc nhở.'
            );
        }

        if ($ticket->ticket_status !== 'active') {
            if ($ticket->ticket_status === 'used') {
                return back()->with(
                    'error',
                    'Hành khách này đã được kiểm tra.'
                );
            }

            return back()->with(
                'error',
                'Vé hiện không ở trạng thái hoạt động.'
            );
        }

        if (!$ticket->booking->user) {
            return back()->with(
                'error',
                'Không tìm thấy tài khoản khách hàng để gửi thông báo.'
            );
        }

        if (!$ticket->flight) {
            return back()->with(
                'error',
                'Không tìm thấy chuyến bay của vé.'
            );
        }

        $flight = $ticket->flight;

        $departureCity =
            $flight->departureAirport->city
            ?? $flight->departureAirport->name
            ?? 'Không xác định';

        $arrivalCity =
            $flight->arrivalAirport->city
            ?? $flight->arrivalAirport->name
            ?? 'Không xác định';

        $flightDate = Carbon::parse(
            $flight->flight_date
        )->format('d/m/Y');

        $departureTime = Carbon::parse(
            $flight->departure_time
        )->format('H:i');

        Notification::create([
            'user_id' => $ticket->booking->user_id,
            'ticket_id' => $ticket->id,
            'sender_id' => Auth::id(),
            'title' => 'Nhắc nhở chuyến bay ' . $flight->flight_code,
            'message' =>
                'Chuyến bay '
                . $flight->flight_code
                . ' từ '
                . $departureCity
                . ' đến '
                . $arrivalCity
                . ' sẽ khởi hành lúc '
                . $departureTime
                . ' ngày '
                . $flightDate
                . '. Hành khách '
                . $ticket->passenger_name
                . ' hiện chưa được kiểm tra. Vui lòng có mặt tại sân bay để làm thủ tục.',
            'status' => 'unread',
        ]);

        return back()->with(
            'success',
            'Đã gửi nhắc nhở cho hành khách '
            . $ticket->passenger_name
            . '.'
        );
    }

    public function flights(Request $request)
    {
        $keyword = trim(
            (string) $request->input('keyword', '')
        );

        $status = $request->input('status');

        $flightDate = $request->input(
            'flight_date',
            Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d')
        );

        $timePeriod = $request->input('time_period');

        $query = Flight::with([
            'departureAirport',
            'arrivalAirport',
            'aircraft',
            'flightSeats',
            'tickets.booking',
        ]);

        if ($keyword !== '') {
            $query->where(function ($subQuery) use ($keyword) {
                $subQuery
                    ->where(
                        'flight_code',
                        'like',
                        '%' . $keyword . '%'
                    )
                    ->orWhereHas(
                        'departureAirport',
                        function ($airportQuery) use ($keyword) {
                            $airportQuery
                                ->where(
                                    'city',
                                    'like',
                                    '%' . $keyword . '%'
                                )
                                ->orWhere(
                                    'code',
                                    'like',
                                    '%' . $keyword . '%'
                                );
                        }
                    )
                    ->orWhereHas(
                        'arrivalAirport',
                        function ($airportQuery) use ($keyword) {
                            $airportQuery
                                ->where(
                                    'city',
                                    'like',
                                    '%' . $keyword . '%'
                                )
                                ->orWhere(
                                    'code',
                                    'like',
                                    '%' . $keyword . '%'
                                );
                        }
                    );
            });
        }

        if ($status) {
            $query->where(
                'status',
                $status
            );
        }

        if ($flightDate) {
            $query->whereDate(
                'flight_date',
                $flightDate
            );
        }

        if ($timePeriod === 'morning') {
            $query
                ->whereTime(
                    'departure_time',
                    '>=',
                    '05:00:00'
                )
                ->whereTime(
                    'departure_time',
                    '<',
                    '12:00:00'
                );
        } elseif ($timePeriod === 'afternoon') {
            $query
                ->whereTime(
                    'departure_time',
                    '>=',
                    '12:00:00'
                )
                ->whereTime(
                    'departure_time',
                    '<',
                    '18:00:00'
                );
        } elseif ($timePeriod === 'evening') {
            $query->where(function ($timeQuery) {
                $timeQuery
                    ->whereTime(
                        'departure_time',
                        '>=',
                        '18:00:00'
                    )
                    ->orWhereTime(
                        'departure_time',
                        '<',
                        '05:00:00'
                    );
            });
        }

        $flights = $query
            ->orderBy('flight_date')
            ->orderBy('departure_time')
            ->get();

        foreach ($flights as $flight) {
            $flight->total_seats_count =
                $flight->flightSeats->count();

            $flight->booked_seats_count =
                $flight->flightSeats
                    ->where('status', 'booked')
                    ->count();

            $validTickets = $flight->tickets
                ->filter(function ($ticket) {
                    return
                        $ticket->booking
                        &&
                        $ticket->booking->payment_status === 'paid'
                        &&
                        in_array(
                            $ticket->ticket_status,
                            ['active', 'used'],
                            true
                        );
                });

            $flight->total_passengers_count =
                $validTickets->count();

            $flight->checked_passengers_count =
                $validTickets
                    ->where('ticket_status', 'used')
                    ->count();

            $flight->unchecked_passengers_count =
                $validTickets
                    ->where('ticket_status', 'active')
                    ->count();

            $flightDateValue = Carbon::parse(
                $flight->flight_date
            )->format('Y-m-d');

            $departureDateTime = Carbon::parse(
                $flightDateValue . ' ' . $flight->departure_time,
                'Asia/Ho_Chi_Minh'
            );

            $now = Carbon::now(
                'Asia/Ho_Chi_Minh'
            );

            $flight->departure_datetime =
                $departureDateTime;

            $flight->minutes_until_departure =
                $now->diffInMinutes(
                    $departureDateTime,
                    false
                );

            if ($departureDateTime->isPast()) {
                $flight->time_warning = 'departed';
            } elseif (
                $flight->minutes_until_departure <= 60
            ) {
                $flight->time_warning = 'urgent';
            } elseif (
                $flight->minutes_until_departure <= 180
            ) {
                $flight->time_warning = 'soon';
            } else {
                $flight->time_warning = 'normal';
            }
        }

        return view(
            'nhanvien.danh-sach-chuyen-bay',
            compact(
                'flights',
                'keyword',
                'status',
                'flightDate',
                'timePeriod'
            )
        );
    }

    public function flightPassengers(Flight $flight)
    {
        $flight->load([
            'departureAirport',
            'arrivalAirport',
            'aircraft',
        ]);

        $tickets = Ticket::with([
            'booking',
            'flightSeat',
        ])
            ->where(
                'flight_id',
                $flight->id
            )
            ->whereIn(
                'ticket_status',
                ['active', 'used']
            )
            ->whereHas(
                'booking',
                function ($query) {
                    $query->where(
                        'payment_status',
                        'paid'
                    );
                }
            )
            ->orderBy('passenger_name')
            ->get();

        return view(
            'nhanvien.hanh-khach-chuyen-bay',
            compact(
                'flight',
                'tickets'
            )
        );
    }

    public function faceRecognition(Ticket $ticket)
    {
        $ticket->load('booking');

        if (!$ticket->booking) {
            return redirect()
                ->route('nhanvien.passengers.unchecked')
                ->with(
                    'error',
                    'Không tìm thấy thông tin đặt vé.'
                );
        }

        if ($ticket->booking->payment_status !== 'paid') {
            return redirect()
                ->route('nhanvien.passengers.unchecked')
                ->with(
                    'error',
                    'Vé chưa thanh toán nên không thể nhận diện.'
                );
        }

        if ($ticket->ticket_status === 'used') {
            return redirect()
                ->route('nhanvien.passengers.unchecked')
                ->with(
                    'error',
                    'Hành khách này đã được xác nhận trước đó.'
                );
        }

        if ($ticket->ticket_status !== 'active') {
            return redirect()
                ->route('nhanvien.passengers.unchecked')
                ->with(
                    'error',
                    'Vé hiện không ở trạng thái hoạt động.'
                );
        }

        if (!$ticket->face_image) {
            return redirect()
                ->route('nhanvien.passengers.unchecked')
                ->with(
                    'error',
                    'Hành khách chưa đăng ký khuôn mặt.'
                );
        }

        $verification = session(
            'employee_face_verified_' . $ticket->id
        );

        $verified = false;
        $similarity = null;

        if (
            is_array($verification)
            &&
            isset(
                $verification['employee_id'],
                $verification['verified_at']
            )
            &&
            (int) $verification['employee_id']
                === (int) Auth::id()
            &&
            now()->timestamp
                - (int) $verification['verified_at']
                <= 300
        ) {
            $verified = true;

            $similarity =
                $verification['similarity'] ?? null;

            $ticket->load([
                'booking.user',
                'flight.departureAirport',
                'flight.arrivalAirport',
                'flight.aircraft',
                'flightSeat',
            ]);
        } else {
            session()->forget(
                'employee_face_verified_' . $ticket->id
            );
        }

        return view(
            'nhanvien.nhan-dien-khuon-mat',
            compact(
                'ticket',
                'verified',
                'similarity'
            )
        );
    }

    public function verifyFace(
        Request $request,
        Ticket $ticket
    ) {
        $ticket->load('booking');

        session()->forget(
            'employee_face_verified_' . $ticket->id
        );

        if (
            !$ticket->booking
            ||
            $ticket->booking->payment_status !== 'paid'
        ) {
            return back()->with(
                'error',
                'Vé chưa được thanh toán.'
            );
        }

        if ($ticket->ticket_status !== 'active') {
            return back()->with(
                'error',
                'Vé hiện không ở trạng thái hoạt động.'
            );
        }

        if (!$ticket->face_image) {
            return back()->with(
                'error',
                'Không tìm thấy ảnh khuôn mặt đã đăng ký.'
            );
        }

        $request->validate([
            'face_image' => [
                'required',
                'string',
            ],
        ], [
            'face_image.required' =>
                'Vui lòng chụp khuôn mặt trước khi kiểm tra.',
        ]);

        $imageData =
            $request->input('face_image');

        if (!preg_match(
            '/^data:image\/(jpeg|jpg|png|webp);base64,/',
            $imageData,
            $matches
        )) {
            return back()->with(
                'error',
                'Dữ liệu ảnh vừa chụp không hợp lệ.'
            );
        }

        $extension = strtolower(
            $matches[1]
        );

        if ($extension === 'jpeg') {
            $extension = 'jpg';
        }

        $base64Data = substr(
            $imageData,
            strpos($imageData, ',') + 1
        );

        $decodedImage = base64_decode(
            $base64Data,
            true
        );

        if ($decodedImage === false) {
            return back()->with(
                'error',
                'Không thể xử lý ảnh vừa chụp.'
            );
        }

        if (
            strlen($decodedImage)
            > 5 * 1024 * 1024
        ) {
            return back()->with(
                'error',
                'Ảnh khuôn mặt không được lớn hơn 5MB.'
            );
        }

        $temporaryDirectory = storage_path(
            'app/face-scans'
        );

        if (!is_dir($temporaryDirectory)) {
            mkdir(
                $temporaryDirectory,
                0755,
                true
            );
        }

        $temporaryPath =
            $temporaryDirectory
            . DIRECTORY_SEPARATOR
            . 'ticket_'
            . $ticket->id
            . '_'
            . uniqid()
            . '.'
            . $extension;

        $saved = file_put_contents(
            $temporaryPath,
            $decodedImage
        );

        if ($saved === false) {
            return back()->with(
                'error',
                'Không thể lưu ảnh vừa chụp.'
            );
        }

        $registeredRelativePath =
            ltrim(
                str_replace(
                    '\\',
                    '/',
                    $ticket->face_image
                ),
                '/'
            );

        $registeredPath = public_path(
            $registeredRelativePath
        );

        $detectorModel = storage_path(
            'app/face-models/face_detection_yunet_2023mar.onnx'
        );

        $recognizerModel = storage_path(
            'app/face-models/face_recognition_sface_2021dec.onnx'
        );

        $scriptPath = base_path(
            'python/face_verify.py'
        );

        $pythonPath =
            'C:\\Users\\tring\\AppData\\Local\\Programs\\Python\\Python312\\python.exe';

        if (!file_exists($pythonPath)) {
            @unlink($temporaryPath);

            return back()->with(
                'error',
                'Không tìm thấy Python tại đường dẫn đã cấu hình.'
            );
        }

        if (!file_exists($registeredPath)) {
            @unlink($temporaryPath);

            return back()->with(
                'error',
                'Không tìm thấy ảnh khuôn mặt đã đăng ký.'
            );
        }

        if (!file_exists($detectorModel)) {
            @unlink($temporaryPath);

            return back()->with(
                'error',
                'Không tìm thấy model YuNet.'
            );
        }

        if (!file_exists($recognizerModel)) {
            @unlink($temporaryPath);

            return back()->with(
                'error',
                'Không tìm thấy model SFace.'
            );
        }

        if (!file_exists($scriptPath)) {
            @unlink($temporaryPath);

            return back()->with(
                'error',
                'Không tìm thấy file face_verify.py.'
            );
        }

        $command =
            escapeshellarg($pythonPath)
            . ' '
            . escapeshellarg($scriptPath)
            . ' '
            . escapeshellarg($registeredPath)
            . ' '
            . escapeshellarg($temporaryPath)
            . ' '
            . escapeshellarg($detectorModel)
            . ' '
            . escapeshellarg($recognizerModel);

        $output = [];
        $exitCode = 0;

        exec(
            $command . ' 2>&1',
            $output,
            $exitCode
        );

        @unlink($temporaryPath);

        $rawOutput = trim(
            implode("\n", $output)
        );

        $result = json_decode(
            $rawOutput,
            true
        );

        if (!is_array($result)) {
            return back()->with(
                'error',
                'Python trả về lỗi: '
                . ($rawOutput !== ''
                    ? $rawOutput
                    : 'Không có dữ liệu phản hồi.')
            );
        }

        if (
            !($result['success'] ?? false)
        ) {
            return back()->with(
                'error',
                $result['message']
                ?? 'Không thể xử lý khuôn mặt.'
            );
        }

        if (
            !($result['matched'] ?? false)
        ) {
            return back()
                ->with(
                    'error',
                    'Khuôn mặt không khớp. Vui lòng chụp lại.'
                )
                ->with(
                    'similarity',
                    $result['similarity'] ?? null
                );
        }

        session()->put(
            'employee_face_verified_' . $ticket->id,
            [
                'employee_id' => Auth::id(),
                'verified_at' => now()->timestamp,
                'similarity' =>
                    $result['similarity'] ?? null,
            ]
        );

        return redirect()
            ->route(
                'nhanvien.tickets.face',
                $ticket
            )
            ->with(
                'success',
                'Nhận diện khuôn mặt thành công.'
            );
    }

    public function confirm(Ticket $ticket)
    {
        $ticket->load('booking');

        if (
            !$ticket->booking
            ||
            $ticket->booking->payment_status !== 'paid'
        ) {
            return back()->with(
                'error',
                'Vé chưa được thanh toán nên không thể xác nhận.'
            );
        }

        if ($ticket->ticket_status === 'used') {
            return back()->with(
                'error',
                'Hành khách này đã được xác nhận trước đó.'
            );
        }

        if ($ticket->ticket_status === 'cancelled') {
            return back()->with(
                'error',
                'Vé đã bị hủy nên không thể xác nhận.'
            );
        }

        if ($ticket->ticket_status !== 'active') {
            return back()->with(
                'error',
                'Vé hiện không hợp lệ.'
            );
        }

        $verification = session(
            'employee_face_verified_' . $ticket->id
        );

        $verified =
            is_array($verification)
            &&
            isset(
                $verification['employee_id'],
                $verification['verified_at']
            )
            &&
            (int) $verification['employee_id']
                === (int) Auth::id()
            &&
            now()->timestamp
                - (int) $verification['verified_at']
                <= 300;

        if (!$verified) {
            session()->forget(
                'employee_face_verified_' . $ticket->id
            );

            return redirect()
                ->route(
                    'nhanvien.tickets.face',
                    $ticket
                )
                ->with(
                    'error',
                    'Bạn phải nhận diện khuôn mặt thành công trước khi xác nhận hành khách.'
                );
        }

        $ticket->update([
            'ticket_status' => 'used',
        ]);

        session()->forget(
            'employee_face_verified_' . $ticket->id
        );

        return redirect()
            ->route(
                'nhanvien.passengers.unchecked'
            )
            ->with(
                'success',
                'Đã xác nhận hành khách '
                . $ticket->passenger_name
                . ' thành công.'
            );
    }
}