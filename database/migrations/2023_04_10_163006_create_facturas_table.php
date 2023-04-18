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
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cli_id')->nullable();
            $table->unsignedBigInteger('med_id')->nullable();
            $table->unsignedBigInteger('emp_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('config_id')->nullable();
            $table->decimal('fac_total')->nullable();
            $table->unsignedBigInteger('fac_estado');
            $table->string('fac_pago', 50)->nullable();
            $table->unsignedBigInteger('fac_descuento')->nullable();
            $table->string('fac_observacion', 255)->nullable();
            $table->string('fac_referencia', 255)->nullable();
            $table->decimal('fac_importe')->nullable();
            $table->decimal('fac_cambio')->nullable();
            //$table->unsignedBigInteger('fac_iva')->nullable();
            $table->timestamps();

            $table->foreign('cli_id')->references('id')->on('clientes');
            $table->foreign('med_id')->references('id')->on('medicos');
            $table->foreign('emp_id')->references('id')->on('empresas');
            $table->foreign('config_id')->references(('id'))->on('configurations');
            $table->foreign('user_id')->references('id')->on(('users'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
