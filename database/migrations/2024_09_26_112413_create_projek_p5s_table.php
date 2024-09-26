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
        Schema::create('projek_p5', function (Blueprint $table) {
            $table->id();
            $table->string('tema');
            $table->enum('Fase',['E','F']);
            $table->string('nama_projek');
            $table->longText('deskripsi_projek');
            $table->unsignedBigInteger('target_capaian_id');
            $table->foreign(columns: 'target_capaian_id')->references('id')->on(table: 'referensi_p5');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projek_p5');
    }
};