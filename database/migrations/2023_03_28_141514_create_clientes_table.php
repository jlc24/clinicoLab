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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('cli_cod', 50)->unique();
            $table->string('cli_nombre', 50);
            $table->string('cli_apellido_pat', 50);
            $table->string('cli_apellido_mat', 50)->nullable();
            $table->string('cli_ci_nit', 10)->nullable();
            $table->string('cli_exp_ci', 10)->nullable();
            $table->date('cli_fec_nac');
            $table->string('cli_genero', 10);
            $table->string('cli_correo', 255)->nullable();
            $table->string('cli_direccion', 255)->nullable();
            $table->string('cli_celular', 15)->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('cli_usuario', 10);
            $table->string('cli_password', 255);
            $table->string('cli_qr', 255)->nullable();
            $table->unsignedBigInteger('dep_id')->nullable();
            $table->unsignedBigInteger('mun_id')->nullable();
            $table->unsignedBigInteger('emp_id')->nullable();
            $table->unsignedBigInteger('med_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('dep_id')->references('id')->on('departamentos');
            $table->foreign('mun_id')->references('id')->on('municipios');
            $table->foreign('emp_id')->references('id')->on('empresas');
            $table->foreign('med_id')->references('id')->on('medicos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
