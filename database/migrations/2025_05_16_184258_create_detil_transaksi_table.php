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
        Schema::create('detil_transaksi', function (Blueprint $table) {
            $table->id('id_detil_transaksi');
            $table->integer('jumlah');
            // Foreign Keys
            $table->unsignedBigInteger('id_jamu');
            $table->unsignedBigInteger('id_transaksi');

            $table->timestamps();

            // Set foreign key constraints
            $table->foreign('id_jamu')->references('id_jamu')->on('jamu')->onDelete('cascade');
            $table->foreign('id_transaksi')->references('id_transaksi')->on('transaksi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detil_transaksi');
    }
};
