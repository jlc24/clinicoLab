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
            $table->unsignedBigInteger('estado');
            $table->timestamps();

            $table->foreign('det_id')->references('id')->on('detalles');
            $table->foreign('proc_id')->references('id')->on('procedimientos');
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
