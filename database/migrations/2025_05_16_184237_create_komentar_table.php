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
        Schema::create('komentar', function (Blueprint $table) {
            $table->id('id_komentar');
            $table->text('komentar');
            $table->smallInteger('rating');

            // Foreign Keys
            $table->unsignedBigInteger('id_jamu');
            $table->unsignedBigInteger('id_user');

            $table->timestamps();

            // Set foreign key constraints
            $table->foreign('id_jamu')->references('id_jamu')->on('jamu')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komentar');
    }
};
