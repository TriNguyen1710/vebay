<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table
                ->string('refund_status', 50)
                ->nullable()
                ->after('ticket_status');

            $table
                ->decimal('refund_amount', 15, 2)
                ->nullable()
                ->after('refund_status');

            $table
                ->string('refund_bank_name', 100)
                ->nullable()
                ->after('refund_amount');

            $table
                ->string('refund_account_number', 50)
                ->nullable()
                ->after('refund_bank_name');

            $table
                ->string('refund_account_name', 150)
                ->nullable()
                ->after('refund_account_number');

            $table
                ->timestamp('refund_requested_at')
                ->nullable()
                ->after('refund_account_name');

            $table
                ->timestamp('refunded_at')
                ->nullable()
                ->after('refund_requested_at');
        });
    }

    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn([
                'refund_status',
                'refund_amount',
                'refund_bank_name',
                'refund_account_number',
                'refund_account_name',
                'refund_requested_at',
                'refunded_at',
            ]);
        });
    }
};