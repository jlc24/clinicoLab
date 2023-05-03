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
        Schema::create('componente_aspectos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dp_id');
            $table->unsignedBigInteger('asp_id');
            $table->unsignedBigInteger('umed_id');
            $table->timestamps();

            $table->foreign('dp_id')->references('id')->on('detalle_procedimientos');
            $table->foreign('asp_id')->references('id')->on('aspectos');
            $table->foreign('umed_id')->references('id')->on('u_medidas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('componente_aspectos');
    }
};
