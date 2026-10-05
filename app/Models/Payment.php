<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'booking_id',
        'payment_code',
        'amount',
        'payment_method',
        'payment_status',
        'paid_at',
    ];

    protected $casts = [
        'amount' => 'decimal:0',
        'paid_at' => 'datetime',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}