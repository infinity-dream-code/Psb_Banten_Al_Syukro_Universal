<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_ruang', function (Blueprint $table) {
            $table->id();
            $table->string('ruang', 100);
            $table->integer('kapasitas')->default(0);
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_ruang');
    }
};
