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
        Schema::create('apostas', function (Blueprint $table) {
            $table->id();
            $table->integer('cpf')->index();
            $table->string('nome');
            $table->integer('timeA');
            $table->integer('timeb');
            $table->string('pri_gol');
            $table->string('pri_cartao');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apostas');
    }
};
