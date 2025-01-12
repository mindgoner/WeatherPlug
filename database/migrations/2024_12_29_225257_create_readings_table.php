<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('readings', function (Blueprint $table) {
            $table->id('readingId');
            $table->foreignId('readingSensorId')->constrained('sensors', 'sensorId');
            $table->double('readingTemperature');
            $table->double('readingHumidity')->nullable();
            $table->date('readingDate')->nullable();
            $table->time('readingTime')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('readings');
    }
};
