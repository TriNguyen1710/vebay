<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FlightSearchController;
use App\Http\Controllers\SeatSelectionController;
use App\Http\Controllers\PassengerController;
use App\Http\Controllers\BaggageController;
use App\Http\Controllers\FaceController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotificationController;

use App\Http\Controllers\Admin\AirportController;
use App\Http\Controllers\Admin\AircraftController;
use App\Http\Controllers\Admin\FlightController;
use App\Http\Controllers\Admin\FlightSeatController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\RefundSettingController;
use App\Http\Controllers\Admin\BaggagePackageController;

use App\Http\Controllers\NhanVien\TicketCheckController;

Route::get(
    '/dang-ky',
    [AuthController::class, 'showRegister']
)->name('dang-ky');

Route::post(
    '/dang-ky',
    [AuthController::class, 'register']
)->name('dang-ky.store');

Route::get(
    '/dang-nhap',
    [AuthController::class, 'showLogin']
)->name('dang-nhap');

Route::post(
    '/dang-nhap',
    [AuthController::class, 'login']
)->name('dang-nhap.xu-ly');

Route::post(
    '/dang-nhap-tai-cho',
    [AuthController::class, 'loginInline']
)->name('dang-nhap.tai-cho');

Route::post(
    '/dang-xuat',
    [AuthController::class, 'logout']
)
    ->middleware('auth')
    ->name('dang-xuat');

Route::get(
    '/tim-chuyen-bay',
    [FlightSearchController::class, 'index']
)->name('flights.search.form');

Route::get(
    '/ket-qua-chuyen-bay',
    [FlightSearchController::class, 'search']
)->name('flights.search');

Route::get(
    '/chuyen-bay/{flight}/chon-ghe',
    [SeatSelectionController::class, 'show']
)->name('seats.show');

Route::post(
    '/chuyen-bay/{flight}/chon-ghe',
    [SeatSelectionController::class, 'select']
)->name('seats.select');

Route::get('/', function () {
    return view('trang-chu');
})->name('trang-chu');

Route::middleware('auth')->group(function () {

    Route::get(
        '/thong-tin-ca-nhan',
        [ProfileController::class, 'edit']
    )->name('profile.edit');

    Route::put(
        '/thong-tin-ca-nhan',
        [ProfileController::class, 'update']
    )->name('profile.update');

    Route::get(
        '/thong-bao',
        [NotificationController::class, 'index']
    )->name('notifications.index');

    Route::post(
        '/thong-bao/{notification}/da-doc',
        [NotificationController::class, 'markAsRead']
    )->name('notifications.read');

    Route::get(
        '/thong-tin-hanh-khach',
        [PassengerController::class, 'create']
    )->name('passenger.create');

    Route::post(
        '/thong-tin-hanh-khach',
        [PassengerController::class, 'store']
    )->name('passenger.store');

    Route::get(
        '/chon-hanh-ly',
        [BaggageController::class, 'create']
    )->name('baggage.create');

    Route::post(
        '/chon-hanh-ly',
        [BaggageController::class, 'store']
    )->name('baggage.store');

    Route::get(
        '/quet-khuon-mat',
        [FaceController::class, 'create']
    )->name('face.create');

    Route::post(
        '/quet-khuon-mat',
        [FaceController::class, 'store']
    )->name('face.store');

    Route::get(
        '/xac-nhan-dat-ve',
        [PassengerController::class, 'confirm']
    )->name('booking.confirm');

    Route::post(
        '/dat-ve',
        [BookingController::class, 'store']
    )->name('booking.store');

    Route::get(
        '/thanh-toan/{booking}',
        [BookingController::class, 'payment']
    )->name('payment.show');

    Route::post(
        '/thanh-toan/{booking}',
        [BookingController::class, 'pay']
    )->name('payment.pay');

    Route::get(
        '/ve-dien-tu/{booking}',
        [BookingController::class, 'ticket']
    )->name('ticket.show');

    Route::get(
        '/ve-cua-toi',
        [BookingController::class, 'myTickets']
    )->name('tickets.mine');

    Route::get(
        '/doi-ve/{ticket}',
        [BookingController::class, 'changeFlight']
    )->name('ticket.change.flight');

    Route::get(
        '/doi-ve/{ticket}/chuyen-bay/{flight}/chon-ghe',
        [BookingController::class, 'changeSeat']
    )->name('ticket.change.seat');

    Route::post(
        '/doi-ve/{ticket}/xac-nhan',
        [BookingController::class, 'changeConfirm']
    )->name('ticket.change.confirm');

    Route::post(
        '/doi-ve/{ticket}/thanh-toan',
        [BookingController::class, 'changePay']
    )->name('ticket.change.pay');

    Route::get(
        '/huy-ve/{ticket}',
        [BookingController::class, 'cancelTicket']
    )->name('ticket.cancel');

    Route::post(
        '/huy-ve/{ticket}',
        [BookingController::class, 'submitCancellation']
    )->name('ticket.cancel.submit');
});

Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        Route::get('/trang-chu', function () {
            return view('admin.trang-chu');
        })->name('admin.trang-chu');

        Route::get(
            '/san-bay',
            [AirportController::class, 'index']
        )->name('admin.airports.index');

        Route::get(
            '/san-bay/them',
            [AirportController::class, 'create']
        )->name('admin.airports.create');

        Route::post(
            '/san-bay',
            [AirportController::class, 'store']
        )->name('admin.airports.store');

        Route::get(
            '/san-bay/{airport}/sua',
            [AirportController::class, 'edit']
        )->name('admin.airports.edit');

        Route::put(
            '/san-bay/{airport}',
            [AirportController::class, 'update']
        )->name('admin.airports.update');

        Route::delete(
            '/san-bay/{airport}',
            [AirportController::class, 'destroy']
        )->name('admin.airports.destroy');

        Route::get(
            '/may-bay',
            [AircraftController::class, 'index']
        )->name('admin.aircraft.index');

        Route::get(
            '/may-bay/them',
            [AircraftController::class, 'create']
        )->name('admin.aircraft.create');

        Route::post(
            '/may-bay',
            [AircraftController::class, 'store']
        )->name('admin.aircraft.store');

        Route::get(
            '/may-bay/{aircraft}/sua',
            [AircraftController::class, 'edit']
        )->name('admin.aircraft.edit');

        Route::put(
            '/may-bay/{aircraft}',
            [AircraftController::class, 'update']
        )->name('admin.aircraft.update');

        Route::delete(
            '/may-bay/{aircraft}',
            [AircraftController::class, 'destroy']
        )->name('admin.aircraft.destroy');

        Route::get(
            '/chuyen-bay',
            [FlightController::class, 'index']
        )->name('admin.flights.index');

        Route::get(
            '/chuyen-bay/them',
            [FlightController::class, 'create']
        )->name('admin.flights.create');

        Route::post(
            '/chuyen-bay',
            [FlightController::class, 'store']
        )->name('admin.flights.store');

        Route::get(
            '/chuyen-bay/{flight}/sua',
            [FlightController::class, 'edit']
        )->name('admin.flights.edit');

        Route::put(
            '/chuyen-bay/{flight}',
            [FlightController::class, 'update']
        )->name('admin.flights.update');

        Route::delete(
            '/chuyen-bay/{flight}',
            [FlightController::class, 'destroy']
        )->name('admin.flights.destroy');

        Route::get(
            '/chuyen-bay/{flight}/ghe',
            [FlightSeatController::class, 'index']
        )->name('admin.flight-seats.index');

        Route::get(
            '/nguoi-dung',
            [UserController::class, 'index']
        )->name('admin.users.index');

        Route::get(
            '/nguoi-dung/them',
            [UserController::class, 'create']
        )->name('admin.users.create');

        Route::post(
            '/nguoi-dung',
            [UserController::class, 'store']
        )->name('admin.users.store');

        Route::get(
            '/nguoi-dung/{user}/sua',
            [UserController::class, 'edit']
        )->name('admin.users.edit');

        Route::put(
            '/nguoi-dung/{user}',
            [UserController::class, 'update']
        )->name('admin.users.update');

        Route::delete(
            '/nguoi-dung/{user}',
            [UserController::class, 'destroy']
        )->name('admin.users.destroy');

        Route::get(
            '/ve',
            [AdminBookingController::class, 'index']
        )->name('admin.bookings.index');

        Route::get(
            '/ve/{booking}',
            [AdminBookingController::class, 'show']
        )->name('admin.bookings.show');

        Route::post(
            '/ve/{booking}/xac-nhan-thanh-toan',
            [AdminBookingController::class, 'confirmPayment']
        )->name('admin.bookings.confirm-payment');

        Route::post(
            '/ve/{booking}/hoan-tien/{ticket}',
            [AdminBookingController::class, 'confirmRefund']
        )->name('admin.bookings.confirm-refund');

        Route::get(
            '/hanh-ly',
            [BaggagePackageController::class, 'index']
        )->name('admin.baggage.index');

        Route::put(
            '/hanh-ly/xach-tay',
            [BaggagePackageController::class, 'updateCarryOn']
        )->name('admin.baggage.carry-on.update');

        Route::get(
            '/hanh-ly/ky-gui/them',
            [BaggagePackageController::class, 'createChecked']
        )->name('admin.baggage.checked.create');

        Route::post(
            '/hanh-ly/ky-gui',
            [BaggagePackageController::class, 'storeChecked']
        )->name('admin.baggage.checked.store');

        Route::get(
            '/hanh-ly/ky-gui/{baggagePackage}/sua',
            [BaggagePackageController::class, 'editChecked']
        )->name('admin.baggage.checked.edit');

        Route::put(
            '/hanh-ly/ky-gui/{baggagePackage}',
            [BaggagePackageController::class, 'updateChecked']
        )->name('admin.baggage.checked.update');

        Route::delete(
            '/hanh-ly/ky-gui/{baggagePackage}',
            [BaggagePackageController::class, 'destroyChecked']
        )->name('admin.baggage.checked.destroy');

        Route::get(
            '/thong-ke',
            [StatisticController::class, 'index']
        )->name('admin.statistics.index');

        Route::get(
            '/cai-dat',
            [SettingController::class, 'edit']
        )->name('admin.settings.edit');

        Route::put(
            '/cai-dat',
            [SettingController::class, 'update']
        )->name('admin.settings.update');

        Route::get(
            '/cai-dat-hoan-ve',
            [RefundSettingController::class, 'edit']
        )->name('admin.refund-settings.edit');

        Route::put(
            '/cai-dat-hoan-ve',
            [RefundSettingController::class, 'update']
        )->name('admin.refund-settings.update');
    });

Route::prefix('nhan-vien')
    ->middleware(['auth', 'nhanvien'])
    ->group(function () {

        Route::get('/trang-chu', function () {
            return view('nhanvien.trang-chu');
        })->name('nhanvien.trang-chu');

        Route::get(
            '/tra-cuu-ve',
            [TicketCheckController::class, 'index']
        )->name('nhanvien.tickets.index');

        Route::get(
            '/tim-ve',
            [TicketCheckController::class, 'search']
        )->name('nhanvien.tickets.search');

        Route::get(
            '/hanh-khach-chua-kiem-tra',
            [TicketCheckController::class, 'uncheckedPassengers']
        )->name('nhanvien.passengers.unchecked');

        Route::get(
            '/chuyen-bay',
            [TicketCheckController::class, 'flights']
        )->name('nhanvien.flights.index');

        Route::get(
            '/chuyen-bay/{flight}/hanh-khach',
            [TicketCheckController::class, 'flightPassengers']
        )->name('nhanvien.flights.passengers');

        Route::post(
            '/ve/{ticket}/nhac-nho',
            [TicketCheckController::class, 'remind']
        )->name('nhanvien.tickets.remind');

        Route::get(
            '/ve/{ticket}/nhan-dien-khuon-mat',
            [TicketCheckController::class, 'faceRecognition']
        )->name('nhanvien.tickets.face');

        Route::post(
            '/ve/{ticket}/nhan-dien-khuon-mat',
            [TicketCheckController::class, 'verifyFace']
        )->name('nhanvien.tickets.face.verify');

        Route::post(
            '/ve/{ticket}/xac-nhan',
            [TicketCheckController::class, 'confirm']
        )->name('nhanvien.tickets.confirm');
    });