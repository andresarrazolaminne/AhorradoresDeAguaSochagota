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
        Schema::create('registro_interes', function (Blueprint $table) {
            $table->id();
            $table->string('full_name', 255);
            $table->string('cedula', 20);
            $table->string('email', 255);
            $table->unsignedSmallInteger('household_size')->nullable();
            $table->string('age_range', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_interes');
    }
};
