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
        Schema::create('penilaian_sumatif', function (Blueprint $table) {
            $table->id('id_penilaian');
            $table->unsignedBigInteger('anggota_kelas');
            $table->foreign(columns: 'anggota_kelas')->references('id_anggota_kelas')->on(table: 'anggota_kelas');
            $table->unsignedBigInteger('pembelajaran');
            $table->foreign(columns: 'pembelajaran')->references('id_pembelajaran')->on(table: 'pembelajaran');
            $table->integer('nilai');
            $table->string('deskripsi_capaian_tertinggi');
            $table->string('deskripsi_capaian_terendah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_sumatif');
    }
};
