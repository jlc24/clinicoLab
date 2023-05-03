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
        Schema::create('detalle_procedimientos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('det_id');
            $table->unsignedBigInteger('proc_id');
            $table->unsignedBigInteger('comp_id')->nullable();
            $table->unsignedBigInteger('estado');
            $table->timestamps();

            $table->foreign('det_id')->references('id')->on('detalles');
            $table->foreign('proc_id')->references('id')->on('procedimientos');
            $table->foreign('comp_id')->references('id')->on('componentes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_procedimientos');
    }
};
