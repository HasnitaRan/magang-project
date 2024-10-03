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
        Schema::create('guru', function (Blueprint $table) {
            $table->id('id_guru');
            $table->string('nama_guru',50);
            $table->enum('jenis_kelamin',['L','P']);
            $table->string('nip',18);
            $table->string('tempat_lahir',20);
            $table->date('tgl_lahir');
            $table->string('no_hp',13);
            $table->string('alamat',200);
            $table->string('foto_profil',100)->nullable();
            $table->foreignId('user_id')->constrained('users', indexName: 'guru_user_id');
            $table->foreignId('agama_id')->constrained('agama', indexName: 'guru_agama_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guru');
    }
};