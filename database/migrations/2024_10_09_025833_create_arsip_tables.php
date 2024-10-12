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
        // Tabel Rombongan Belajar Arsip
        Schema::create('rombel_arsip', function (Blueprint $table) {
            $table->id('id_arsip_rombel');
            $table->unsignedBigInteger('rombel_id');
            $table->foreign(columns: 'rombel_id')->references('id_rombel')->on(table: 'rombongan_belajar');
            $table->timestamps();
        });

        // Tabel Catatan Wali Kelas Arsip
        Schema::create('catatanWalkel_arsip', function (Blueprint $table) {
            $table->id('id_arsip_catatanWalkel');
            $table->unsignedBigInteger('catatanWalkel_id');
            $table->foreign(columns: 'catatanWalkel_id')->references('id_catatanWalkel')->on(table: 'catatan_walikelas');
            $table->timestamps();
        });

        // Tabel Anggota Rombel Arsip
        Schema::create('anggotaRombel_arsip', function (Blueprint $table) {
            $table->id('id_arsip_anggotaRombel');
            $table->unsignedBigInteger('anggotaRombel_id');
            $table->foreign(columns: 'anggotaRombel_id')->references('id_anggotaRombel')->on(table: 'anggota_rombel');
            $table->timestamps();
        });

        // Tabel Kehadiran Arsip
        Schema::create('kehadiran_arsip', function (Blueprint $table) {
            $table->id('id_arsip_kehadiran');
            $table->unsignedBigInteger('kehadiran_id');
            $table->foreign(columns: 'kehadiran_id')->references('id_kehadiran')->on(table: 'kehadiran');
            $table->timestamps();
        });

        // Tabel Pembelajaran Arsip
        Schema::create('pembelajaran_arsip', function (Blueprint $table) {
            $table->id('id_arsip_pembelajaran');
            $table->unsignedBigInteger('pembelajaran_id');
            $table->foreign(columns: 'pembelajaran_id')->references('id_pembelajaran')->on(table: 'pembelajaran');
            $table->timestamps();
        });

        // Tabel Penilaian Sumatif Arsip
        Schema::create('penilaianSum_arsip', function (Blueprint $table) {
            $table->id('id_arsip_penilaianSum');
            $table->unsignedBigInteger('penilaian_id');
            $table->foreign(columns: 'penilaian_id')->references('id_penilaian')->on(table: 'penilaian_sumatif');
            $table->timestamps();
        });

        // Tabel Kelompok Proyek Arsip
        Schema::create('kelProjek_arsip', function (Blueprint $table) {
            $table->id('id_arsip_kelProjek');
            $table->unsignedBigInteger('kelompok_id');
            $table->foreign(columns: 'kelompok_id')->references('id_kelompok')->on(table: 'kelompok_projek');
            $table->timestamps();
        });

        // Tabel Penilaian P5 Arsip
        Schema::create('penilaianP5_arsip', function (Blueprint $table) {
            $table->id('id_arsip_penilaianP5');
            $table->unsignedBigInteger('penilaianP5_id');
            $table->foreign(columns: 'penilaianP5_id')->references('id_penilaianP5')->on(table: 'penilaian_p5');
            $table->timestamps();
        });

        // Tabel Proyek P5 Arsip
        Schema::create('projekP5_arsip', function (Blueprint $table) {
            $table->id('id_arsip_projekP5');
            $table->unsignedBigInteger('projek_id');
            $table->foreign(columns: 'projek_id')->references('id_projekP5')->on(table: 'projek_p5');
            $table->timestamps();
        });

        // Tabel Anggota Ekstrakurikuler Arsip
        Schema::create('anggotaEkskul_arsip', function (Blueprint $table) {
            $table->id('id_arsip_anggotaEkskul');
            $table->unsignedBigInteger('anggotaEkskul_id');
            $table->foreign(columns: 'anggotaEkskul_id')->references('id_anggotaEkskul')->on(table: 'anggota_ekskul');
            $table->timestamps();
        });

        // Tabel Nilai Ekstrakurikuler Arsip
        Schema::create('nilaiEkskul_arsip', function (Blueprint $table) {
            $table->id('id_arsip_nilaiEkskul');
            $table->unsignedBigInteger('nilaiEkskul_id');
            $table->foreign(columns: 'nilaiEkskul_id')->references('id_nilaiEkskul')->on(table: 'nilai_ekstrakulikuler');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rombel_arsip');
        Schema::dropIfExists('catatanWalkel_arsip');
        Schema::dropIfExists('anggotaRombel_arsip');
        Schema::dropIfExists('kehadiran_arsip');
        Schema::dropIfExists('pembelajaran_arsip');
        Schema::dropIfExists('penilaianSum_arsip');
        Schema::dropIfExists('kelProjek_arsip');
        Schema::dropIfExists('penilaianP5_arsip');
        Schema::dropIfExists('projekP5_arsip');
        Schema::dropIfExists('anggotaEkskul_arsip');
        Schema::dropIfExists('nilaiEkskul_arsip');
    }
};
