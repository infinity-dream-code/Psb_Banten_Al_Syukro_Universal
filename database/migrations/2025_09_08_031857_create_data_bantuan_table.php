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
    Schema::create('data_bantuan', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('id_peserta');
        $table->string('no_kks', 20)->nullable();
        $table->string('no_kps', 20)->nullable();
        $table->text('usulan_pip')->nullable();
        $table->string('nomor_kip', 20)->nullable();
        $table->string('nama_kip', 100)->nullable();
        $table->text('alasan_menolak_kip')->nullable();
        $table->string('no_reg_akta_lahir', 20)->nullable();
        $table->timestamp('created_at')->nullable();
        $table->timestamp('updated_at')->nullable();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_bantuan');
    }
};
