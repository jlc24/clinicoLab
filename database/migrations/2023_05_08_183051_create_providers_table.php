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
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->string('prov_nombre', 255);
            $table->unsignedBigInteger('emp_id')->nullable();
            $table->unsignedBigInteger('prov_nit')->nullable();
            $table->string('prov_direccion', 255)->nullable();
            $table->unsignedBigInteger('prov_telefono')->nullable();
            $table->string('prov_email', 255)->nullable();
            $table->string('prov_web', 255)->nullable();
            $table->string('prov_descripcion', 255)->nullable();
            $table->string('prov_notas', 255)->nullable();
            $table->timestamps();

            $table->foreign('emp_id')->references('id')->on('empresas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('providers');
    }
};
