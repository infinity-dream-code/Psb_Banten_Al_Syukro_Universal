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
        Schema::create('temporary', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('id_jalur')->nullable();
        $table->unsignedBigInteger('id_fakultas')->nullable();
        $table->unsignedBigInteger('id_prodi')->nullable();
        $table->integer('biaya_pendaftaran')->nullable();
        $table->integer('biaya_registrasi')->nullable();
        $table->json('detail')->nullable();
        $table->timestamp('created_at')->nullable();
        $table->timestamp('updated_at')->nullable();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temporary');
    }
};
