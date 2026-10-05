<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('baggage_packages', function (Blueprint $table) {
            $table->id();

            $table->string('type', 20);

            $table->string('name')
                ->nullable();

            $table->unsignedInteger('weight');

            $table->decimal('price', 12, 0)
                ->default(0);

            $table->boolean('status')
                ->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('baggage_packages');
    }
};