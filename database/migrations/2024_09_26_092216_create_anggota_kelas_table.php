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
        Schema::create('anggota_rombel', function (Blueprint $table) {
            $table->id('id_anggotaRombel');
            $table->unsignedBigInteger('rombel_id');
            $table->foreign(columns: 'rombel_id')->references('id_rombel')->on('rombongan_belajar');
            $table->unsignedBigInteger('anggota_rombel');
            $table->foreign(columns: 'anggota_rombel')->references('id_siswa')->on('siswa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota_kelas');
    }
};