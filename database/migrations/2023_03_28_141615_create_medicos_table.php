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
            $table->string('med_apellido_pat', 20);
            $table->string('med_apellido_mat', 20);
            $table->string('med_ci_nit', 10);
            $table->string('med_exp_ci', 10);
            $table->string('med_genero', 10);
            $table->string('med_correo')->nullable();
            $table->string('med_celular', 15)->nullable();
            $table->string('med_direccion')->nullable();
            $table->string('med_especialidad', 50)->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('med_usuario', 10);
            $table->string('med_password');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
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
