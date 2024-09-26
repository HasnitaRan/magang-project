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
            $table->id();
            $table->enum('nilai',['sangat baik','baik','cukup','kurang']);
            $table->string('keterangan');
            $table->unsignedBigInteger(column: 'anggota_ekskul_id');
            $table->foreign(columns: 'anggota_ekskul_id')->references('id_anggota_ekskul')->on(table: 'anggota_ekskul');
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
