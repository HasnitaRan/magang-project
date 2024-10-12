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
            $table->unsignedBigInteger('anggotaRombel_id');
            $table->foreign(columns: 'anggotaRombel_id')->references('id_anggotaRombel')->on(table: 'anggota_rombel');
            $table->unsignedBigInteger('pembelajaran_id');
            $table->foreign(columns: 'pembelajaran_id')->references('id_pembelajaran')->on(table: 'pembelajaran');
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
