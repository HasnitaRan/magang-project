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
        Schema::create('penilaian_p5', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anggota_kelompok_id');
            $table->foreign(columns: 'anggota_kelompok_id')->references('id')->on(table: 'kelompok_projek');
            $table->unsignedBigInteger('projek_p5_id');
            $table->foreign(columns: 'projek_p5_id')->references('id')->on(table: 'projek_p5');
            $table->foreignId('referensi_p5_id')->constrained('referensi_p5',indexName:'target_capaian_id');
            $table->enum('nilai',['1','2','3','4']);
            //Mulai Berkembang, Sedang Berkembang, Berkembang Sesuai Harapan, Sangat Berkembang
            $table->longText('catatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_p5');
    }
};
