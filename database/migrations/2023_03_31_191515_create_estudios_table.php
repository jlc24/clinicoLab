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
        Schema::create('estudios', function (Blueprint $table) {
            $table->id();
            $table->string('est_cod', 10);
            $table->string('est_nombre', 255);
            $table->string('est_descripcion', 255)->nullable();
            $table->decimal('est_precio')->nullable();
            $table->unsignedBigInteger('umed_id')->nullable();
            $table->timestamps();

            $table->foreign('umed_id')->references('id')->on('u_medidas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudios');
    }
};
