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
        Schema::create('kehadiran', function (Blueprint $table) {
            $table->id('id_kehadiran');
            $table->integer('sakit')->nullable();
            $table->integer('izin')->nullable();
            $table->integer(column: 'tanpa_keterangan')->nullable();
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
        Schema::dropIfExists('kehadiran');
    }
};