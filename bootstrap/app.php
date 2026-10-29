<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\EnsureBookingFaceVerified;
use App\Http\Middleware\NhanVienMiddleware;
use App\Http\Middleware\RecordTicketCheckIn;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',

        then: function () {
            require __DIR__.'/../routes/check-in.php';
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {

        // Nếu chưa đăng nhập thì chuyển về trang đăng nhập.
        $middleware->redirectGuestsTo(function (Request $request) {
            return route('dang-nhap');
        });

        $middleware->web(append: [
            EnsureBookingFaceVerified::class,
            RecordTicketCheckIn::class,
        ]);

        $middleware->alias([
            'admin' => AdminMiddleware::class,
            'nhanvien' => NhanVienMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();