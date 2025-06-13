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
        Schema::create('konsultasi', function (Blueprint $table) {
        $table->id();
        $table->string('nama_siswa');
        $table->string('asal_sekolah');
        $table->json('jawaban'); // Menyimpan jawaban dalam format JSON
        $table->json('hasil'); // Menyimpan hasil analisis
        $table->string('metode'); // forward atau backward
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konsultasi');
    }
};
