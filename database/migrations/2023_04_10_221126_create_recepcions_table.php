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
        Schema::create('recepcions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('det_id');
            $table->unsignedBigInteger('cli_id');
            $table->unsignedBigInteger('med_id')->nullable();
            $table->unsignedBigInteger('emp_id')->nullable();
            $table->string('estado', 15)->define('Pendiente');
            $table->string('observacion', 255)->nullable();
            $table->string('referencia', 255)->nullable();
            $table->timestamps();

            $table->foreign('det_id')->references('id')->on('detalles');
            $table->foreign('cli_id')->references('id')->on('clientes');
            $table->foreign('med_id')->references('id')->on('medicos');
            $table->foreign('emp_id')->references('id')->on('empresas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recepcions');
    }
};
