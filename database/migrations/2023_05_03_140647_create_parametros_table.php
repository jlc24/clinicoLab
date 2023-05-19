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
        Schema::create('parametros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ca_id');
            $table->string('genero', 10)->nullable();
            $table->unsignedBigInteger('edad_inicial')->nullable();
            $table->unsignedBigInteger('edad_final')->nullable();
            $table->string('tiempo', 10)->nullable();
            $table->unsignedDecimal('valor_inicial')->nullable();
            $table->unsignedDecimal('valor_final')->nullable();
            $table->string('referencia')->nullable();
            $table->timestamps();

            $table->foreign('ca_id')->references('id')->on('componente_aspectos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parametros');
    }
};
