<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DANH SÁCH THÔNG BÁO CỦA KHÁCH
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $notifications = Notification::with([
            'ticket.flight.departureAirport',
            'ticket.flight.arrivalAirport',
        ])
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return view(
            'user.thong-bao',
            compact('notifications')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ĐÁNH DẤU ĐÃ ĐỌC CỦA KHÁCH
    |--------------------------------------------------------------------------
    */

    public function markAsRead(Notification $notification)
    {
        if ($notification->user_id !== Auth::id()) {
            abort(403);
        }

        $notification->update([
            'status' => 'read',
        ]);

        return back()->with(
            'success',
            'Đã đánh dấu thông báo là đã đọc.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | DANH SÁCH THÔNG BÁO CỦA ADMIN
    |--------------------------------------------------------------------------
    */

    public function adminIndex()
    {
        $notifications = Notification::with([
            'user',
            'ticket.flight.departureAirport',
            'ticket.flight.arrivalAirport',
        ])
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return view(
            'admin.notifications.index',
            compact('notifications')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ĐÁNH DẤU ĐÃ ĐỌC CỦA ADMIN
    |--------------------------------------------------------------------------
    */

    public function adminMarkAsRead(Notification $notification)
    {
        if ($notification->user_id !== Auth::id()) {
            abort(403);
        }

        $notification->update([
            'status' => 'read',
        ]);

        $bookingId = $notification->ticket?->booking_id;

        if ($bookingId) {
            return redirect()->route(
                'admin.bookings.show',
                $bookingId
            );
        }

        return redirect()->route('admin.bookings.index');
    }
}