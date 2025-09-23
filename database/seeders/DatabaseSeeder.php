<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('user')->insert([
            'nama'           => 'admin',
            'username'       => 'admin',
            'password'       => Hash::make('admin123'),
            'plain_password' => 'admin123',
            'role'           => 'admin',
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        DB::table('master_agama')->insert([
            ['nama' => 'Islam', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Kristen Protestan', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Katolik', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Hindu', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Buddha', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Konghucu', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Kepercayaan Terhadap Tuhan YME', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Lainnya', 'created_at' => now(), 'updated_at' => now()],
        ]);

      DB::table('master_pendidikan_ortu')->insert([
    ['nama' => 'Tidak Sekolah', 'created_at' => now(), 'updated_at' => now()],
    ['nama' => 'SD/Sederajat', 'created_at' => now(), 'updated_at' => now()],
    ['nama' => 'SMP/Sederajat', 'created_at' => now(), 'updated_at' => now()],
    ['nama' => 'SMU, SMA, SMK/Sederajat', 'created_at' => now(), 'updated_at' => now()],
    ['nama' => 'D3', 'created_at' => now(), 'updated_at' => now()],
    ['nama' => 'D4', 'created_at' => now(), 'updated_at' => now()],
    ['nama' => 'S1', 'created_at' => now(), 'updated_at' => now()],
    ['nama' => 'S2', 'created_at' => now(), 'updated_at' => now()],
    ['nama' => 'Profesi', 'created_at' => now(), 'updated_at' => now()],
    ['nama' => 'S3', 'created_at' => now(), 'updated_at' => now()],
    ['nama' => 'Lainnya', 'created_at' => now(), 'updated_at' => now()],
]);


      DB::table('master_pekerjaan_ortu')->insert([
    ['nama' => 'Tidak Bekerja', 'created_at' => now(), 'updated_at' => now()],
    ['nama' => 'Nelayan', 'created_at' => now(), 'updated_at' => now()],
    ['nama' => 'Petani', 'created_at' => now(), 'updated_at' => now()],
    ['nama' => 'Peternak', 'created_at' => now(), 'updated_at' => now()],
    ['nama' => 'PNS/TNI/POLRI', 'created_at' => now(), 'updated_at' => now()],
    ['nama' => 'Swasta', 'created_at' => now(), 'updated_at' => now()],
    ['nama' => 'Wiraswasta', 'created_at' => now(), 'updated_at' => now()],
    ['nama' => 'Pensiunan', 'created_at' => now(), 'updated_at' => now()],
    ['nama' => 'Lainnya', 'created_at' => now(), 'updated_at' => now()],
    ['nama' => 'Sudah Meninggal', 'created_at' => now(), 'updated_at' => now()],
]);


       DB::table('master_penghasilan_ortu')->insert([
    ['nama' => 'Kurang Dari Rp. 1 JT', 'created_at' => now(), 'updated_at' => now()],
    ['nama' => 'Rp. 1 JT Hingga Rp. 2 JT', 'created_at' => now(), 'updated_at' => now()],
    ['nama' => 'Lebih Dari Rp. 2 JT', 'created_at' => now(), 'updated_at' => now()],
    ['nama' => 'Diatas Rp. 5 JT', 'created_at' => now(), 'updated_at' => now()],
]);


      DB::table('master_jurusan_sekolah')->insert([
    ['nama' => 'IPA', 'created_at' => now(), 'updated_at' => now()],
    ['nama' => 'IPS', 'created_at' => now(), 'updated_at' => now()],
    ['nama' => 'Bahasa', 'created_at' => now(), 'updated_at' => now()],
    ['nama' => 'SMK Jurusan', 'created_at' => now(), 'updated_at' => now()],
    ['nama' => 'Tidak Ada Jurusan', 'created_at' => now(), 'updated_at' => now()],
]);

DB::table('master_sumber_informasi')->insert([
    ['nama' => 'KELUARGA', 'created_at' => now(), 'updated_at' => now()],
    ['nama' => 'TEMAN', 'created_at' => now(), 'updated_at' => now()],
    ['nama' => 'KORAN', 'created_at' => now(), 'updated_at' => now()],
    ['nama' => 'TV', 'created_at' => now(), 'updated_at' => now()],
    ['nama' => 'RADIO', 'created_at' => now(), 'updated_at' => now()],
    ['nama' => 'MEDIA SOSIAL', 'created_at' => now(), 'updated_at' => now()],
    ['nama' => 'AGENSI', 'created_at' => now(), 'updated_at' => now()],
]);

    }
}
