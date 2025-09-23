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
    Schema::create('master_harga', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('id_jalur');
        $table->unsignedBigInteger('id_gelombang');
        $table->unsignedBigInteger('id_fakultas');
        $table->unsignedBigInteger('id_prodi');
        $table->decimal('harga_final', 12, 2);
        $table->string('nama_jalur', 30);
        $table->string('nama_gelombang', 2);
        $table->string('nama_fakultas', 30);
        $table->string('nama_prodi', 30);
        $table->decimal('harga_registrasi', 12, 2);
        $table->json('detail')->nullable();
        $table->boolean('active')->default(1)->nullable();
        $table->timestamp('created_at')->nullable();
        $table->timestamp('updated_at')->nullable();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_harga');
    }
};
