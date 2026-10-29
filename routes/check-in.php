<?php

use App\Http\Controllers\CheckInHistoryController;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'web',
    'auth',
    'admin',
])->get(
    '/admin/lich-su-check-in',
    [CheckInHistoryController::class, 'admin']
)->name('admin.check-ins.index');

Route::middleware([
    'web',
    'auth',
    'nhanvien',
])->get(
    '/nhan-vien/lich-su-check-in',
    [CheckInHistoryController::class, 'employee']
)->name('nhanvien.check-ins.index');