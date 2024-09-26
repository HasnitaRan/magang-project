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
        Schema::create('elemen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_dimensi')->constrained('dimensi',indexName:'elemen_dimensi_id');
            $table->string('elemen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elemen');
    }
};