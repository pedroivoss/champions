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
            $table->string('cpf')->index();
            $table->string('nome');
            $table->integer('timeA');
            $table->integer('timeB');
            $table->string('pri_gol')->nullable();
            $table->string('pri_cartao')->nullable();
            $table->decimal('valor_aposta', 10, 2)->default(15.00);
            $table->timestamps();
            $table->tinyInteger('status')->default(1); // 1 = ativo, 0 = inativo
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
