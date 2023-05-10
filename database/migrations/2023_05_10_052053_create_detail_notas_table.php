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
        Schema::create('detail_notas', function (Blueprint $table) {
            $table->integer('jumlah')->nullable();
            $table->integer('harga')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('nota_id');
            $table->foreign('nota_id')->references('id')->on('notas');

            $table->unsignedBigInteger('barang_id');
            $table->foreign('barang_id')->references('id')->on('barangs');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_notas');
    }
};
