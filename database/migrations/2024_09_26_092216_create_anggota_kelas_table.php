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
        Schema::create('anggota_kelas', function (Blueprint $table) {
            $table->id('id_anggota_kelas');
            $table->unsignedBigInteger('kelas_id');
            $table->foreign(columns: 'kelas_id')->references('id_kelas')->on('kelas');
            $table->unsignedBigInteger('anggota_kelas');
            $table->foreign(columns: 'anggota_kelas')->references('id_siswa')->on('siswa');
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