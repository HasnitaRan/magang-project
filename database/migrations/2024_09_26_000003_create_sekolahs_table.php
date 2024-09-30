<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    if (!Schema::hasTable('sekolah')) {
        Schema::create('sekolah', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sekolah', 100);
            $table->string('npsn', 8);
            $table->string('jalan', 50);
            $table->string('desa_kelurahan', 50);
            $table->string('kecamatan', 50);
            $table->string('kabupaten', 50);
            $table->string('provinsi', 50);
            $table->string('kode_pos', 5);
            $table->string('no_telp', 13);
            $table->string('website', 255)->nullable();
            $table->string('email', 50);
            $table->string('kepala_sekolah', 50);
            $table->string('nip_kepsek', 18);
            $table->string('logo_sekolah', 100)->nullable();
            $table->timestamps();
        });
    }
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sekolah');
    }
};