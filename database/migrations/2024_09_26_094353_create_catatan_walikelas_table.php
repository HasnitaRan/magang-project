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
        Schema::create('catatan__walikelas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anggota_kelas');
            $table->foreign(columns: 'anggota_kelas')->references('id_anggota_kelas')->on(table: 'anggota_kelas');
            $table->longText('catatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catatan__walikelas');
    }
};