<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payment_review_requests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('booking_id')
                ->constrained('bookings')
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('booking_code');
            $table->decimal('expected_amount', 12, 0);
            $table->string('receipt_path');
            $table->string('receipt_sha256', 64)->index();
            $table->string('transaction_code')->nullable();
            $table->text('receipt_content')->nullable();
            $table->longText('ocr_text')->nullable();
            $table->text('message');
            $table->string('status', 20)->default('pending')->index();

            $table->foreignId('reviewed_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('reviewed_at')->nullable();
            $table->text('reviewer_note')->nullable();
            $table->string('approved_transaction_code')->nullable();
            $table->string('approved_receipt_sha256', 64)->nullable()->unique();
            $table->decimal('received_amount', 12, 0)->nullable();
            $table->timestamps();
            $table->index(['booking_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_review_requests');
    }
};
