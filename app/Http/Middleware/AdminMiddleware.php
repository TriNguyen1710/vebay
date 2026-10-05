<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('dang-nhap');
        }

        if (auth()->user()->role !== 'admin') {
            return redirect()
                ->route('trang-chu')
                ->with('error', 'Bạn không có quyền truy cập trang quản trị.');
        }

        return $next($request);
    }
}