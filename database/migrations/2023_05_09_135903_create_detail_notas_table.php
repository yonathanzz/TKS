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
            $table->id();
            $table->integer('nota_id')->unsigned();
            $table->integer('barang_id')->unsigned();
            $table->integer('jumlah')->nullable();
            $table->integer('harga')->nullable();
            $table->primary(['nota_id', 'barang_id']);
            $table->foreign('nota_id')->references('id')->on('notas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('barang_id')->references('id')->on('barangs')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
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
