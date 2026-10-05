<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->unsignedInteger('baggage_weight')
                ->default(0)
                ->after('price');

            $table->decimal('baggage_price', 12, 0)
                ->default(0)
                ->after('baggage_weight');
        });
    }

    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn([
                'baggage_weight',
                'baggage_price',
            ]);
        });
    }
};