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
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mat_id');
            $table->string('comp_codigo', 50)->nullable();
            $table->date('comp_elaboracion')->nullable();
            $table->date('comp_vencimiento')->nullable();
            $table->unsignedSmallInteger('comp_vida_util')->nullable();
            $table->unsignedDecimal('comp_depreciacion', 8, 2)->nullable();
            $table->unsignedBigInteger('umed_id');
            $table->unsignedBigInteger('comp_cantidad');
            $table->decimal('comp_precio_compra');
            $table->decimal('comp_precio_unitario');
            $table->string('comp_tipo', 50);
            $table->unsignedBigInteger('prov_id')->nullable();
            $table->string('comp_observacion', 255)->nullable();
            $table->unsignedBigInteger('comp_ventas')->nullable();
            $table->unsignedBigInteger('comp_estado')->nullable();
            $table->timestamps();

            $table->foreign('mat_id')->references('id')->on('materials');
            $table->foreign('umed_id')->references('id')->on('u_medidas');
            $table->foreign('prov_id')->references('id')->on('providers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
