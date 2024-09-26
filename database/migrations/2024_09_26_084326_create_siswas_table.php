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
        Schema::create('siswa', function (Blueprint $table) {
            $table->id('id_siswa');
            $table->string('nama_siswa',50);
            $table->string('nis',5);
            $table->string('nisn',10);
            $table->string('tempat_lahir',20);
            $table->date('tgl_lahir');
            $table->enum('jenis_kelamin',['L','P']);
            $table->string('alamat',200);
            $table->string('no_hp',13);
            $table->enum('status_dalam_keluarga',['anak kandung','anak angkat','anak tiri']);
            $table->string('anak_ke')->nullable();
            $table->string('asal_sekolah',100);
            $table->year('tahun_masuk');
            $table->string('foto_profil',100)->nullable();
            $table->foreignId('user_id')->constrained('users', indexName: 'siswa_user_id');
            $table->foreignId('agama')->constrained('agama', indexName: 'siswa_agama_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};