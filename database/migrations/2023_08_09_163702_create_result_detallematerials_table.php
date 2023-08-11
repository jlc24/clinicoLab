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
        Schema::create('result_detallematerials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('result_id');
            $table->unsignedBigInteger('detmat_id');
            $table->unsignedBigInteger('ca_id');
            $table->unsignedBigInteger('mat_id');
            $table->unsignedDecimal('cantidad')->nullable();
            $table->unsignedBigInteger('umed_id')->nullable();
            $table->unsignedDecimal('precio_total', 8, 4)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('result_detallematerials');
    }
};
