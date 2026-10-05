<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();

            $table->string('flight_code')->unique();

            $table->foreignId('aircraft_id')
                ->constrained('aircraft')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('departure_airport_id')
                ->constrained('airports')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('arrival_airport_id')
                ->constrained('airports')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->date('flight_date');

            $table->time('departure_time');
            $table->time('arrival_time');

            $table->decimal('price', 12, 0);

            $table->string('status')->default('open');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};