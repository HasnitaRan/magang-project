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
        Schema::create('admin', function (Blueprint $table) {
            $table->id('id_admin');
            $table->string('nama');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('no_hp');
            $table->string('alamat');
            $table->string('foto_profil')->nullable();
            $table->foreignId('user_id')->constrained('users', indexName: 'admins_user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};