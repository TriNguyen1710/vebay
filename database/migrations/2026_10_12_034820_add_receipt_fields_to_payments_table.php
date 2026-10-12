<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            if (!Schema::hasColumn('payments', 'receipt_image')) {
                $table->string('receipt_image')->nullable();
            }

            if (!Schema::hasColumn('payments', 'receipt_transaction_code')) {
                $table->string('receipt_transaction_code')
                    ->nullable()
                    ->unique();
            }

            if (!Schema::hasColumn('payments', 'receipt_content')) {
                $table->string('receipt_content')->nullable();
            }

            if (!Schema::hasColumn('payments', 'receipt_amount')) {
                $table->decimal('receipt_amount', 12, 0)
                    ->nullable();
            }

            if (!Schema::hasColumn('payments', 'ocr_text')) {
                $table->longText('ocr_text')->nullable();
            }

            if (!Schema::hasColumn('payments', 'paid_at')) {
                $table->timestamp('paid_at')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $columns = [
                'receipt_image',
                'receipt_transaction_code',
                'receipt_content',
                'receipt_amount',
                'ocr_text',
                'paid_at',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('payments', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};