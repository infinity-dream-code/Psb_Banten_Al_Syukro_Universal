<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBantuan extends Model
{
    use HasFactory;

    protected $table = 'data_bantuan';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_peserta',
        'no_kks',
        'no_kps',
        'usulan_pip',
        'nomor_kip',
        'nama_kip',
        'alasan_menolak_kip',
        'no_reg_akta_lahir',
    ];

    public function peserta()
    {
        return $this->belongsTo(DataPeserta::class, 'id_peserta');
    }
}

