<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ticket_id',
        'sender_id',
        'title',
        'message',
        'status',
    ];

    /*
    |--------------------------------------------------------------------------
    | KHÁCH HÀNG NHẬN THÔNG BÁO
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | NHÂN VIÊN GỬI THÔNG BÁO
    |--------------------------------------------------------------------------
    */

    public function sender()
    {
        return $this->belongsTo(
            User::class,
            'sender_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | VÉ LIÊN QUAN
    |--------------------------------------------------------------------------
    */

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}