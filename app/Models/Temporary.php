<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Temporary extends Model
{
    protected $table = 'temporary';

    protected $fillable = [
        'id_jalur',
        'id_fakultas',
        'id_prodi',
        'biaya_pendaftaran',
        'biaya_registrasi',
        'detail',
    ];

    protected $casts = [
        'detail' => 'array',
    ];

    public function jalur()
    {
        return $this->belongsTo(MasterJalur::class, 'id_jalur');
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
