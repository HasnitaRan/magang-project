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
        Schema::create('pembelajaran', function (Blueprint $table) {
            $table->id('id_pembelajaran');
            $table->unsignedBigInteger('kelas_id');
            $table->foreign(columns: 'kelas_id')->references('id_kelas')->on(table: 'kelas');
            $table->unsignedBigInteger('mata_pelajaran_id');
            $table->foreign(columns: 'mata_pelajaran_id')->references('id_mapel')->on(table: 'mata_pelajaran');
            $table->unsignedBigInteger('guru_pengampu_id');
            $table->foreign(columns: 'guru_pengampu_id')->references('id_guru')->on(table: 'guru');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelajaran');
    }
};
