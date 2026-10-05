<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'flight_id',
        'flight_seat_id',
        'seat_class',
        'ticket_code',
        'passenger_name',
        'date_of_birth',
        'gender',
        'identity_number',
        'phone',
        'email',
        'price',
        'baggage_weight',
        'baggage_price',
        'ticket_status',
        'face_image',
        'cccd_image',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'price' => 'decimal:0',
        'baggage_weight' => 'integer',
        'baggage_price' => 'decimal:0',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

    public function flightSeat()
    {
        return $this->belongsTo(FlightSeat::class);
    }
}