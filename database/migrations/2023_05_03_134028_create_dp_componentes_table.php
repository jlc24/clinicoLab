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
        Schema::create('dp_componentes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dp_id');
            $table->unsignedBigInteger('comp_id');
            $table->timestamps();

            $table->foreign('dp_id')->references('id')->on('detalle_procedimientos');
            $table->foreign('comp_id')->references('id')->on('componentes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dp_componentes');
    }
};
