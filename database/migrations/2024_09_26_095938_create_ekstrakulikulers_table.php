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
        Schema::create('ekstrakulikuler', function (Blueprint $table) {
            $table->id('id_ekstrakulikuler');
            $table->string('nama_ekstrakulikuler',45);
            $table->unsignedBigInteger('pembina_id');
            $table->foreign(columns: 'pembina_id')->references('id_guru')->on(table: 'guru');
            $table->unsignedBigInteger(column: 'tahunAjaran_id');
            $table->foreign(columns: 'tahunAjaran_id')->references('id_tahunAjaran')->on(table: 'tahun_ajaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ekstrakulikuler');
    }
};