<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('flight_seats', function (Blueprint $table) {
            $table->string('seat_class')
                ->default('economy')
                ->after('seat_type');
        });
    }

    public function down(): void
    {
        Schema::table('flight_seats', function (Blueprint $table) {
            $table->dropColumn('seat_class');
        });
    }
};