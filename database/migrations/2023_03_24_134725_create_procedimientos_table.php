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
        Schema::create('procedimientos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 255);
            $table->unsignedBigInteger('metodo_id');
            $table->timestamps();

            $table->foreign('metodo_id')->references('id')->on('metodologias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procedimientos');
    }
};
