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
            $table->unsignedBigInteger('valor_inicial')->nullable();
            $table->unsignedBigInteger('valor_final')->nullable();
            $table->unsignedBigInteger('umed_id')->nullable();
            $table->string('cualitativo', 100)->nullable();
            $table->string('referencia')->nullable();
            $table->timestamps();

            $table->foreign('ca_id')->references('id')->on('componente_aspectos');
            $table->foreign('umed_id')->references('id')->on('u_medidas');
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
