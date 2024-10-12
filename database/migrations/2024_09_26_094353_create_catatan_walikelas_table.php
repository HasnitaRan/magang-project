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
        Schema::create('catatan_walikelas', function (Blueprint $table) {
            $table->id('id_catatanWalkel');
            $table->unsignedBigInteger('anggotaRombel_id');
            $table->foreign(columns: 'anggotaRombel_id')->references('id_anggotaRombel')->on(table: 'anggota_rombel');
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