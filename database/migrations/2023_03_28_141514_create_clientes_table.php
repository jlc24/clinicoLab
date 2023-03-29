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
            $table->string('cli_cod', 10)->unique();
            $table->string('cli_nombre', 20);
            $table->string('cli_apellido_pat', 20);
            $table->string('cli_apellido_mat', 20)->nullable();
            $table->string('cli_ci_nit', 10);
            $table->string('cli_exp_ci', 10);
            $table->date('cli_fec_nac');
            $table->string('cli_genero', 10);
            $table->string('cli_correo')->nullable();
            $table->string('cli_direccion')->nullable();
            $table->string('cli_celular', 15)->nullable();
            $table->unsignedBigInteger('dep_id');
            $table->unsignedBigInteger('mun_id');
            $table->timestamps();

            $table->foreign('dep_id')->references('id')->on('departamentos');
            $table->foreign('mun_id')->references('id')->on('municipios');
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
