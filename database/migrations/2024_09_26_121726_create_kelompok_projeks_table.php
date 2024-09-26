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
            $table->id();
            $table->string('nama_kelompok');
            $table->unsignedBigInteger('koordinator');
            $table->foreign(columns: 'koordinator')->references('id_guru')->on(table: 'guru');
            $table->foreignId('projek_p5_id')->constrained('projek_p5',indexName:'projek_p5_id');
            $table->unsignedBigInteger('anggota_kelas');
            $table->foreign(columns: 'anggota_kelas')->references('id_anggota_kelas')->on(table: 'anggota_kelas');
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