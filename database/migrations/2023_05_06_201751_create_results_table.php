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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fac_id');           // factura
            $table->unsignedBigInteger('rec_id');           // recepcion
            $table->unsignedBigInteger('det_id');           // estudio
            $table->unsignedBigInteger('dp_id');            // procedimiento
            $table->unsignedBigInteger('dpc_id');           // componente
            $table->unsignedBigInteger('ca_id');            //aspecto
            $table->unsignedBigInteger('det_mat_id');       // detalle_materials->ca_materials
            $table->string('resultado', 255)->nullable();   // resultado
            $table->unsignedBigInteger('umed_id')->nullable();
            $table->unsignedBigInteger('estado');
            $table->timestamps();

            $table->foreign('fac_id')->references('id')->on('facturas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
