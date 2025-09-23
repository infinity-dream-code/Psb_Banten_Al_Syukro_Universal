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
    Schema::create('master_akademik', function (Blueprint $table) {
        $table->id();
        $table->string('tahun_akademik', 9);
        $table->string('tahun_mulai', 4);
        $table->string('tahun_selesai', 4);
        $table->boolean('active')->default(1);
        $table->timestamp('created_at')->nullable();
        $table->timestamp('updated_at')->nullable();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_akademik');
    }
};
