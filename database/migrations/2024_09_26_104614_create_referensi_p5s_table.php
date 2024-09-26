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
        Schema::create('referensi_p5', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_elemen')->constrained('elemen',indexName:'elemen_id');
            $table->string('sub_elemen');
            $table->enum('fase',['E','F']);
            $table->string('target_capaian');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referensi_p5');
    }
};
