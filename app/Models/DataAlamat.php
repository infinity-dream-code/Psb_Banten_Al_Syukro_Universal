<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAlamat extends Model
{
    use HasFactory;

    protected $table = 'data_alamat';

    protected $fillable = [
        'id_peserta','id_provinsi','id_kabupaten','id_kecamatan','desa','alamat','rt/rw','kode_pos'
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

    public function kecamatan()
    {
        return $this->belongsTo(MasterKecamatan::class,'id_kecamatan');
    }
}
