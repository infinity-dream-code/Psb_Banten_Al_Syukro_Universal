<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tagihan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_peserta')->nullable();
            $table->decimal('biaya_daful', 15, 2)->nullable();
            $table->json('detail')->nullable();
            $table->tinyInteger('status');
            $table->dateTime('tanggal_pembayaran_daful')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tagihan');
    }
};
