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
        Schema::create('anggota_ekskul', function (Blueprint $table) {
            $table->id('id_anggota_ekskul');
            $table->unsignedBigInteger(column: 'ekstrakulikuler_id');
            $table->foreign(columns: 'ekstrakulikuler_id')->references('id_ekstrakulikuler')->on(table: 'ekstrakulikuler');
            $table->unsignedBigInteger(column: 'anggota_ekskul_id');
            $table->foreign(columns: 'anggota_ekskul_id')->references('id_siswa')->on(table: 'siswa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota_ekskul');
    }
};
