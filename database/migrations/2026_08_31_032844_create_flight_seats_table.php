<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('flight_seats', function (Blueprint $table) {
            $table->id();

            $table->foreignId('flight_id')
                ->constrained('flights')
                ->cascadeOnDelete();

            $table->string('seat_number');

            $table->string('seat_type')->default('middle');
            // window = cửa sổ
            // aisle = lối đi
            // middle = ghế giữa

            $table->string('status')->default('available');
            // available = còn trống
            // booked = đã đặt

            $table->timestamps();

            $table->unique(['flight_id', 'seat_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flight_seats');
    }
};