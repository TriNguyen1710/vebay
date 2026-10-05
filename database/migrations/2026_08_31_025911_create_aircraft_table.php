<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aircraft', function (Blueprint $table) {
            $table->id();

            $table->string('code')->unique();
            $table->string('name');

            $table->unsignedInteger('rows');
            $table->unsignedInteger('seats_per_row');
            $table->unsignedInteger('total_seats');

            $table->boolean('status')->default(1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aircraft');
    }
};