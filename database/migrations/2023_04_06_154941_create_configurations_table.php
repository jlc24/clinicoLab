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
        Schema::create('configurations', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50)->nullable();
            $table->string('nit', 20)->nullable();
            $table->string('direccion', 255)->nullable();
            $table->string('pais', 10)->nullable();
            $table->string('departamento', 20)->nullable();
            $table->string('municipio', 50)->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('web', 255)->nullable();
            $table->string('logo', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configurations');
    }
};
