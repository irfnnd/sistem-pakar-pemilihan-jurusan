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
        Schema::create('rule', function (Blueprint $table) {
        $table->id();
        $table->string('kode_kecerdasan', 10);
        $table->string('kode_ciri', 10);
        $table->timestamps();

        $table->foreign('kode_kecerdasan')->references('kode')->on('kecerdasan');
        $table->foreign('kode_ciri')->references('kode')->on('ciri_ciri');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rule');
    }
};
