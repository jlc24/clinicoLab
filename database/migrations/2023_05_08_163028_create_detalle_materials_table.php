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
        Schema::create('detalle_materials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('det_id');
            $table->unsignedBigInteger('mat_id');
            $table->unsignedDecimal('cantidad')->nullable();
            $table->unsignedBigInteger('umed_id')->nullable();
            $table->unsignedDecimal('precio_total', 8, 4)->nullable();
            $table->timestamps();

            $table->foreign('det_id')->references('id')->on('detalles');
            $table->foreign('mat_id')->references('id')->on('materials');
            $table->foreign('umed_id')->references('id')->on('u_medidas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_materials');
    }
};
