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
            $table->unsignedBigInteger('dpcomp_id');
            $table->unsignedBigInteger('asp_id');
            $table->unsignedBigInteger('umed_id')->nullable();
            $table->timestamps();

            $table->foreign('dpcomp_id')->references('id')->on('dp_componentes');
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
