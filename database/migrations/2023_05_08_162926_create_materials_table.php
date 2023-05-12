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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('mat_cod', 100);
            $table->string('mat_nombre', 100);
            $table->string('mat_descripcion', 255)->nullable();
            $table->string('mat_imagen', 255)->nullable();
            $table->unsignedBigInteger('umed_id')->nullable();
            $table->unsignedBigInteger('mat_cantidad')->nullable();
            $table->unsignedBigInteger('mat_cantidad_minima')->nullable();
            $table->decimal('mat_precio_compra')->nullable();
            $table->decimal('mat_precio_unitario')->nullable();
            $table->unsignedBigInteger('mat_ventas')->nullable();
            $table->unsignedBigInteger('mat_estado')->nullable();
            $table->unsignedBigInteger('cat_id')->nullable();
            $table->unsignedBigInteger('comp_id')->nullable();
            $table->timestamps();

            $table->foreign('umed_id')->references('id')->on('u_medidas');
            $table->foreign('cat_id')->references('id')->on('categorias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
