<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    use HasFactory;

    protected $table = 'ujian';
    protected $fillable = ['id_master_ujian', 'id_peserta', 'tanggal', 'ruang'];

    protected $casts = [
    'tanggal' => 'datetime',
];


    public function masterUjian()
    {
        return $this->belongsTo(MasterUjian::class, 'id_master_ujian');
    }

    public function peserta()
    {
        return $this->belongsTo(DataPeserta::class, 'id_peserta');
    }
}
