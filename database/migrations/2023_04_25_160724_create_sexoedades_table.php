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
        Schema::create('sexoedades', function (Blueprint $table) {
            $table->id();
            $table->string('genero', 10);
            $table->unsignedBigInteger('edad_inicial');
            $table->unsignedBigInteger('edad_final');
            $table->string('tiempo', 10);
            $table->unsignedBigInteger('valor_inicial');
            $table->unsignedBigInteger('valor_final');
            $table->string('referencia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sexoedades');
    }
};
