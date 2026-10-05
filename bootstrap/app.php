<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\NhanVienMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        // Nếu chưa đăng nhập thì chuyển về trang đăng nhập
        $middleware->redirectGuestsTo(function (Request $request) {
            return route('dang-nhap');
        });

        // Đặt tên cho middleware phân quyền
        $middleware->alias([
            'admin' => AdminMiddleware::class,
            'nhanvien' => NhanVienMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();