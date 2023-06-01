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
            $table->string('rec_codigo', 20)->nullable();
            $table->unsignedBigInteger('caja_id');
            $table->unsignedBigInteger('fac_id');
            $table->unsignedBigInteger('det_id');
            $table->string('estado', 15)->define('Pendiente');
            $table->string('rec_ruta_file', 255)->nullable();
            $table->timestamps();

            $table->foreign('caja_id')->references('id')->on('cajas');
            $table->foreign('fac_id')->references('id')->on('facturas');
            $table->foreign('det_id')->references('id')->on('detalles');
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
