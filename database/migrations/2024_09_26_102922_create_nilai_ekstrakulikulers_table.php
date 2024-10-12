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
        Schema::create('nilai_ekstrakulikuler', function (Blueprint $table) {
            $table->id('id_nilaiEkskul');
            $table->enum('nilai',['sangat baik','baik','cukup','kurang']);
            $table->string('keterangan');
            $table->unsignedBigInteger(column: 'anggotaEkskul_id');
            $table->foreign(columns: 'anggotaEkskul_id')->references('id_anggotaEkskul')->on(table: 'anggota_ekskul');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_ekstrakulikuler');
    }
};
