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
        Schema::create('jamu', function (Blueprint $table) {
            $table->id('id_jamu');
            $table->string('nama_jamu', 64);
            $table->integer('harga');
            $table->text('komposisi');
            $table->text('deskripsi');
            $table->text('gambar');
            $table->text('aturan_pakai');
            $table->integer('berat');
            $table->integer('stok');
            $table->text('manfaat');
            $table->json('id_kategori')->nullable(); // array
            $table->text('fitur_index')->nullable(); // kolom tambahan agar mempercepat proses prediksi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jamu');
    }
};
