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
        Schema::create('medicos', function (Blueprint $table) {
            $table->id();
            $table->string('med_cod', 10)->unique();
            $table->string('med_nombre', 20);
            $table->string('med_apellido', 50);
            $table->string('med_genero', 10);
            $table->string('med_correo')->nullable();
            $table->string('med_direccion')->nullable();
            $table->string('med_especialidad')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicos');
    }
};
