<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();

            // Khách hàng nhận thông báo
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Vé liên quan đến thông báo
            $table->foreignId('ticket_id')
                ->nullable()
                ->constrained('tickets')
                ->nullOnDelete();

            // Nhân viên gửi thông báo
            $table->foreignId('sender_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('title');

            $table->text('message');

            // unread = chưa đọc
            // read   = đã đọc
            $table->string('status')
                ->default('unread');

            $table->timestamps();

            $table->index(['user_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};