<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'flight_code',
        'aircraft_id',
        'departure_airport_id',
        'arrival_airport_id',
        'flight_date',
        'departure_time',
        'arrival_time',
        'price',
        'vip_surcharge',
        'status',
    ];

    protected $casts = [
        'flight_date' => 'date',
        'price' => 'decimal:0',
        'vip_surcharge' => 'decimal:0',
    ];


    /*
    |--------------------------------------------------------------------------
    | MÁY BAY
    |--------------------------------------------------------------------------
    */

    public function aircraft()
    {
        return $this->belongsTo(
            Aircraft::class
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SÂN BAY ĐI
    |--------------------------------------------------------------------------
    */

    public function departureAirport()
    {
        return $this->belongsTo(
            Airport::class,
            'departure_airport_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SÂN BAY ĐẾN
    |--------------------------------------------------------------------------
    */

    public function arrivalAirport()
    {
        return $this->belongsTo(
            Airport::class,
            'arrival_airport_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | GHẾ CỦA CHUYẾN BAY
    |--------------------------------------------------------------------------
    */

    public function flightSeats()
    {
        return $this->hasMany(
            FlightSeat::class
        );
    }


    /*
    |--------------------------------------------------------------------------
    | VÉ CỦA CHUYẾN BAY
    |--------------------------------------------------------------------------
    */

    public function tickets()
    {
        return $this->hasMany(
            Ticket::class
        );
    }


    /*
    |--------------------------------------------------------------------------
    | GIÁ VÉ VIP
    |--------------------------------------------------------------------------
    */

    public function getVipPriceAttribute()
    {
        return
            $this->price
            +
            $this->vip_surcharge;
    }
}