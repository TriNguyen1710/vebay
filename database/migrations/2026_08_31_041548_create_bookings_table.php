<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('booking_code')
                ->unique();

            $table->decimal('total_amount', 12, 0)
                ->default(0);

            // pending / confirmed / cancelled
            $table->string('booking_status')
                ->default('pending');

            // unpaid / paid / failed
            $table->string('payment_status')
                ->default('unpaid');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};