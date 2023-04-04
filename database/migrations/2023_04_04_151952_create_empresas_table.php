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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('emp_cod', 10);
            $table->string('emp_nombre', 50);
            $table->string('emp_nit', 20)->nullable();
            $table->string('emp_direccion', 255);
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
        Schema::dropIfExists('empresas');
    }
};
