<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightSeat extends Model
{
    use HasFactory;

    protected $fillable = [
        'flight_id',
        'seat_number',
        'seat_type',
        'seat_class',
        'status',
    ];

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }
}