<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterHarga extends Model
{
    protected $table = 'master_harga';

    protected $fillable = [
        'id_jalur',
        'id_gelombang',
        'id_fakultas',
        'id_prodi',
        'harga_final',
        'harga_registrasi',
        'detail',
        'nama_jalur',
        'nama_gelombang',
        'nama_fakultas',
        'nama_prodi',
        'active',
    ];

    protected $casts = [
        'detail' => 'array',
        'harga_final' => 'decimal:2',
        'harga_registrasi' => 'decimal:2',
    ];

    public function jalur()
    {
        return $this->belongsTo(MasterJalur::class, 'id_jalur');
    }

    public function gelombang()
    {
        return $this->belongsTo(MasterGelombang::class, 'id_gelombang');
    }

    public function fakultas()
    {
        return $this->belongsTo(MasterFakultas::class, 'id_fakultas');
    }

    public function prodi()
    {
        return $this->belongsTo(MasterProdi::class, 'id_prodi');
    }
}
