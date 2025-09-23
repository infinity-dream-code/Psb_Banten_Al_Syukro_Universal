<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSekolah extends Model
{
    use HasFactory;

    protected $table = 'data_sekolah';

    protected $fillable = [
        'id_peserta','id_provinsi','id_kabupaten','nama_sekolah','alamat','id_jurusan','tahun_lulus','nisn'
    ];

    public function peserta()
    {
        return $this->belongsTo(DataPeserta::class,'id_peserta');
    }

    public function provinsi()
    {
        return $this->belongsTo(MasterProvinsi::class,'id_provinsi');
    }

    public function kabupaten()
    {
        return $this->belongsTo(MasterKabupaten::class,'id_kabupaten');
    }

    public function jurusan()
    {
        return $this->belongsTo(MasterJurusanSekolah::class,'id_jurusan');
    }
}
