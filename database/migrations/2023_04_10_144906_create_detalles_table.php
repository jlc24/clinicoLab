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
        Schema::create('detalles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('estudio_id');
            $table->unsignedBigInteger('muestra_id');
            $table->unsignedBigInteger('recipiente_id')->nullable();
            $table->unsignedBigInteger('indicacion_id')->nullable();
            $table->unsignedDecimal('precio', 8, 4)->nullable();
            $table->unsignedBigInteger('umed_id')->nullable();
            $table->string('tipo', 20)->nullable();
            $table->timestamps();

            $table->foreign('estudio_id')->references('id')->on('estudios')->onDelete('cascade');
            $table->foreign('muestra_id')->references('id')->on('muestras')->onDelete('cascade');
            $table->foreign('recipiente_id')->references('id')->on('recipientes')->onDelete('cascade');
            $table->foreign('indicacion_id')->references('id')->on('indications')->onDelete('cascade');
            $table->foreign('umed_id')->references('id')->on('u_medidas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalles');
    }
};
