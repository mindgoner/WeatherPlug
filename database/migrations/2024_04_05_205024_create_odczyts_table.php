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
        Schema::create('odczyts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('deviceId');
            $table->double('Temperatura');
            $table->integer("Cisnienie");
            $table->integer('Wilgotnosc');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('odczyts');
    }
};
