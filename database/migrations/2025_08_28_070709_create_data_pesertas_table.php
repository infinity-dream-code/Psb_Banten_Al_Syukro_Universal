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
    Schema::create('data_peserta', function (Blueprint $table) {
        $table->id();
        $table->foreignId('id_user')->nullable();
        $table->string('no_pendaftaran', 50)->nullable();
        $table->foreignId('id_gelombang')->nullable();
        $table->string('gelombang', 50)->nullable();
        $table->foreignId('id_jalur')->nullable();
        $table->string('jalur', 100)->nullable();
        $table->foreignId('id_fakultas')->nullable();
        $table->string('fakultas', 100)->nullable();
        $table->foreignId('id_prodi')->nullable();
        $table->string('prodi', 100)->nullable();
        $table->integer('id_master_harga')->nullable();
        $table->string('nama_peserta', 150)->nullable();
        $table->string('nik', 20)->nullable();
        $table->string('no_kk', 16)->nullable();
        $table->string('tempat_lahir', 100)->nullable();
        $table->date('tanggal_lahir')->nullable();
        $table->string('nisn', 50)->nullable();
        $table->string('no_akta_lahir', 50)->nullable();
        $table->string('gender', 10)->nullable();
        $table->string('agama', 15)->nullable();
        $table->string('kewarganegaraan', 50)->nullable();
        $table->string('email', 100)->nullable();
        $table->string('no_hp', 20)->nullable();
        $table->text('alamat_lengkap')->nullable();
        $table->string('dusun', 100)->nullable();
        $table->string('kecamatan', 100)->nullable();
        $table->string('kabupaten', 100)->nullable();
        $table->string('provinsi', 100)->nullable();
        $table->integer('id_provinsi')->nullable();
        $table->integer('id_kabupaten')->nullable();
        $table->integer('id_kecamatan')->nullable();
        $table->string('kode_pos', 10)->nullable();
        $table->string('nama_sekolah', 150)->nullable();
        $table->string('kota_sekolah', 100)->nullable();
        $table->string('provinsi_sekolah', 100)->nullable();
        $table->integer('id_provinsi_sekolah')->nullable();
        $table->integer('id_kabupaten_sekolah')->nullable();
        $table->string('jurusan', 100)->nullable();
        $table->integer('id_jurusan')->nullable();
        $table->year('tahun_lulus')->nullable();
        $table->string('status_sekolah', 50)->nullable();
        $table->text('alamat_sekolah')->nullable();
        $table->string('ibu_nama', 150)->nullable();
        $table->date('ibu_tanggal_lahir')->nullable();
        $table->string('ibu_nik', 20)->nullable();
        $table->text('ibu_alamat')->nullable();
        $table->string('ibu_suku', 50)->nullable();
        $table->string('ibu_pendidikan', 100)->nullable();
        $table->integer('id_pendidikan_ibu')->nullable();
        $table->string('ibu_pekerjaan', 100)->nullable();
        $table->integer('id_pekerjaan_ibu')->nullable();
        $table->string('ibu_penghasilan', 100)->nullable();
        $table->integer('id_penghasilan_ibu')->nullable();
        $table->string('ibu_no_tlp', 20)->nullable();
        $table->string('ayah_nama', 150)->nullable();
        $table->date('ayah_tanggal_lahir')->nullable();
        $table->string('ayah_nik', 20)->nullable();
        $table->text('ayah_alamat')->nullable();
        $table->string('ayah_suku', 50)->nullable();
        $table->string('ayah_pendidikan', 100)->nullable();
        $table->integer('id_pendidikan_ayah')->nullable();
        $table->string('ayah_pekerjaan', 100)->nullable();
        $table->integer('id_pekerjaan_ayah')->nullable();
        $table->string('ayah_penghasilan', 100)->nullable();
        $table->integer('id_penghasilan_ayah')->nullable();
        $table->string('ayah_no_tlp', 20)->nullable();
        $table->integer('jml_saudara_kandung')->nullable();
        $table->integer('jml_saudara_yayasan')->nullable();
        $table->integer('id_sumber')->nullable();
        $table->string('nama_sumber', 100)->nullable();
        $table->string('foto', 255)->nullable();
        $table->string('dokumen_kk', 255)->nullable();
        $table->string('dokumen_ktp_ortu', 255)->nullable();
        $table->string('dokumen_akte_kelahiran', 255)->nullable();
        $table->string('va_number', 50)->nullable();
        $table->string('status_paid', 20)->nullable();
        $table->boolean('status_pembayaran_registrasi')->nullable();
        $table->date('tgl_bayar_daftar')->nullable();
        $table->string('status_ujian', 11)->nullable();
        $table->date('tgl_bayar_regis')->nullable();
        $table->dateTime('batas_awal_registrasi')->nullable();
        $table->dateTime('batas_akhir_registrasi')->nullable();
        $table->dateTime('pembekalan')->nullable();
        $table->dateTime('created_at')->nullable();
        $table->dateTime('updated_at')->nullable();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pesertas');
    }
};
