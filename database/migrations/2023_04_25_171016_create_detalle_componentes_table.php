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
        Schema::create('detalle_componentes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proc_id');
            $table->unsignedBigInteger('comp_id');
            $table->unsignedBigInteger('umed_id')->nullable();
            $table->string('tabla_referencia')->nullable();
            $table->unsignedBigInteger('tabla_id')->nullable();
            $table->unsignedBigInteger('sexoedad_id')->nullable();
            $table->unsignedBigInteger('rango_id')->nullable();
            $table->unsignedBigInteger('cual_id')->nullable();
            $table->unsignedBigInteger('texto_id')->nullable();
            $table->timestamps();

            $table->foreign('proc_id')->references('id')->on('procedimientos');
            $table->foreign('comp_id')->references('id')->on('componentes');
            $table->foreign('umed_id')->references('id')->on('u_medidas');
            $table->foreign('tabla_id')->references('id')->on('tablas');
            $table->foreign('sexoedad_id')->references('id')->on('sexoedades');
            $table->foreign('rango_id')->references('id')->on('rangos');
            $table->foreign('cual_id')->references('id')->on('cualitativos');
            $table->foreign('texto_id')->references('id')->on('textos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_componentes');
    }
};
