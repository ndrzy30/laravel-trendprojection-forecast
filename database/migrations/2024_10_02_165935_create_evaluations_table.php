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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->string('obat');
            $table->string('bulan');
            $table->integer('aktual_y')->nullable(); // Penjualan aktual (Yt)
            $table->decimal('prediksi_f', 10, 2); // Prediksi Penjualan (Ft)
            $table->decimal('selisih', 10, 2); // Selisih antara Yt - Ft
            $table->decimal('ape', 10, 2); // APE (%)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};