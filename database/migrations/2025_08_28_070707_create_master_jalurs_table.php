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
    Schema::create('master_jalur', function (Blueprint $table) {
        $table->id();
        $table->string('nama', 50)->nullable();
        $table->boolean('is_active')->nullable();
        $table->boolean('is_free')->nullable();
        $table->timestamp('created_at')->nullable();
        $table->timestamp('updated_at')->nullable();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_jalurs');
    }
};
