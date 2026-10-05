<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaggagePackage extends Model
{
    protected $fillable = [
        'type',
        'name',
        'weight',
        'price',
        'status',
    ];

    protected $casts = [
        'weight' => 'integer',
        'price' => 'integer',
        'status' => 'boolean',
    ];
}