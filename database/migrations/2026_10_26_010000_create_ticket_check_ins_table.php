<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ticket_check_ins', function (Blueprint $table) {
            $table->id();

            $table->foreignId('ticket_id')
                ->nullable()
                ->unique()
                ->constrained('tickets')
                ->nullOnDelete();

            $table->foreignId('booking_id')
                ->nullable()
                ->constrained('bookings')
                ->nullOnDelete();

            $table->foreignId('employee_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Lưu thông tin tại thời điểm check-in.
            $table->string('ticket_code');
            $table->string('booking_code');
            $table->string('passenger_name');
            $table->string('employee_name');
            $table->string('flight_code');
            $table->string('seat_number')->nullable();

            // face hoặc manual.
            $table->string('verification_method', 20);

            $table->timestamp('checked_in_at')->index();

            $table->timestamps();

            $table->index([
                'employee_id',
                'checked_in_at',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ticket_check_ins');
    }
};