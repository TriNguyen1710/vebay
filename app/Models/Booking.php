<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'booking_code',
        'total_amount',
        'booking_status',
        'payment_status',
        'expires_at',
    ];

    protected $casts = [
        'total_amount' => 'decimal:0',
        'expires_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}