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
            $table->string('med_cod', 50)->unique();
            $table->string('med_nombre', 20);
            $table->string('med_apellido_pat', 20);
            $table->string('med_apellido_mat', 20)->nullable();
            $table->string('med_ci_nit', 10)->nullable();
            $table->string('med_exp_ci', 10)->nullable();
            $table->string('med_genero', 10);
            $table->string('med_correo', 255)->nullable();
            $table->string('med_celular', 15)->nullable();
            $table->string('med_direccion', 255)->nullable();
            $table->string('med_especialidad', 50)->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('med_usuario', 10);
            $table->string('med_password', 255);
            $table->unsignedBigInteger('dep_id')->nullable();
            $table->unsignedBigInteger('mun_id')->nullable();
            $table->unsignedDecimal('med_convenio')->nullable();
            $table->string('med_cuenta', 100)->nullable();
            $table->string('med_banco', 150)->nullable();
            $table->string('med_qr', 255)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('dep_id')->references('id')->on('departamentos');
            $table->foreign('mun_id')->references('id')->on('municipios');
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
