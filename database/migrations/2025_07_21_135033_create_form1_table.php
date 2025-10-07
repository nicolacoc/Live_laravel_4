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
        Schema::create('form1', function (Blueprint $table) {
            $table->id();
            $table->string('Nome')->nullable();
            $table->string('Cognome')->nullable();
            $table->string('Società')->nullable();
            $table->string('Qualifica')->nullable();
            $table->string('Email')->nullable();
            $table->string('Telefono')->nullable();
            $table->date('Data_di_Nascita')->nullable();
            $table->longText('Ima')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form1');
    }
};
