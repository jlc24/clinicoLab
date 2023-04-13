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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('config_id')->nullable();
            $table->decimal('fac_total')->nullable();
            $table->unsignedBigInteger('fac_estado')->nullable();
            $table->string('fac_pago', 10)->nullable();
            $table->unsignedBigInteger('fac_descuento')->nullable();
            $table->unsignedBigInteger('fac_iva')->nullable();
            $table->timestamps();

            $table->foreign('cli_id')->references('id')->on('clientes');
            $table->foreign('user_id')->references('id')->on(('users'));
            $table->foreign('config_id')->references(('id'))->on('configurations');
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
