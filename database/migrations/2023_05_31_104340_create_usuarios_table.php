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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('usuario_cod', 50)->unique();
            $table->string('usuario_nombre', 20);
            $table->string('usuario_apellido_pat', 20);
            $table->string('usuario_apellido_mat', 20)->nullable();
            $table->string('usuario_ci_nit', 10);
            $table->string('usuario_exp_ci', 10);
            $table->date('usuario_fec_nac')->nullable();
            $table->string('usuario_genero', 10);
            $table->string('usuario_correo', 255)->nullable();
            $table->string('usuario_direccion', 255)->nullable();
            $table->string('usuario_celular', 15)->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('usuario_usuario', 255);
            $table->string('usuario_password', 255);
            $table->string('usuario_departamento', 50);
            $table->string('usuario_municipio', 50);
            $table->string('usuario_foto', 255)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
