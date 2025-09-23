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
    Schema::create('master_fakultas', function (Blueprint $table) {
        $table->id();
        $table->string('fakultas', 100)->nullable();
        $table->boolean('aktif')->default(1);
        $table->timestamp('created_at')->nullable();
        $table->timestamp('updated_at')->nullable();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_biaya_pendaftarans');
    }
};
