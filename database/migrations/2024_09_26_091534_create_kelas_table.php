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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id('id_kelas');
            $table->string('nama_kelas',6);
            $table->string('tingkatan',2);
            $table->unsignedBigInteger(column: 'tahunAjaran_id');
            $table->foreign(columns: 'tahunAjaran_id')->references('id_tahunAjaran')->on(table: 'tahun_ajaran');
            $table->unsignedBigInteger('wali_kelas_id');
            $table->foreign(columns: 'wali_kelas_id')->references('id_guru')->on(table: 'guru');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};