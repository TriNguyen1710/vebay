<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();

            $table->foreignId('booking_id')
                ->constrained('bookings')
                ->cascadeOnDelete();

            $table->foreignId('flight_id')
                ->constrained('flights')
                ->cascadeOnDelete();

            $table->foreignId('flight_seat_id')
                ->constrained('flight_seats')
                ->cascadeOnDelete();

            $table->string('ticket_code')
                ->unique();

            // Thông tin hành khách
            $table->string('passenger_name');

            $table->date('date_of_birth');

            $table->string('gender', 20);

            $table->string('identity_number', 30);

            $table->string('phone', 20);

            $table->string('email');

            // Giá vé tại thời điểm đặt
            $table->decimal('price', 12, 0);

            // pending / active / cancelled / used
            $table->string('ticket_status')
                ->default('pending');

            /*
             * Sau này dùng cho nhận diện khuôn mặt.
             * Hiện tại chưa lưu gì.
             */
            $table->string('face_image')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};