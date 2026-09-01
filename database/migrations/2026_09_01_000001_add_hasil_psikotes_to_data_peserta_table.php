<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('data_peserta', function (Blueprint $table) {
            $table->string('hasil_psikotes', 255)->nullable()->after('dokumen_akte_kelahiran');
        });
    }

    public function down(): void
    {
        Schema::table('data_peserta', function (Blueprint $table) {
            $table->dropColumn('hasil_psikotes');
        });
    }
};
