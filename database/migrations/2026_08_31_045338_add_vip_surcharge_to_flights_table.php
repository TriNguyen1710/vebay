<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('flights', function (Blueprint $table) {
            $table->decimal('vip_surcharge', 12, 0)
                ->default(0)
                ->after('price');
        });
    }

    public function down(): void
    {
        Schema::table('flights', function (Blueprint $table) {
            $table->dropColumn('vip_surcharge');
        });
    }
};