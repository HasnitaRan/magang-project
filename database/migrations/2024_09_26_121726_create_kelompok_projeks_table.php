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
        Schema::create('kelompok_projek', function (Blueprint $table) {
            $table->id('id_kelompok');
            $table->string('nama_kelompok');
            $table->unsignedBigInteger('koordinator_id');
            $table->foreign(columns: 'koordinator_id')->references('id_guru')->on(table: 'guru');
            $table->unsignedBigInteger('projekP5_id');
            $table->foreign(columns: 'projekP5_id')->references('id_projekP5')->on(table: 'projek_p5');
            $table->unsignedBigInteger('anggotaRombel_id');
            $table->foreign(columns: 'anggotaRombel_id')->references('id_anggotaRombel')->on(table: 'anggota_rombel');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelompok_projek');
    }
};