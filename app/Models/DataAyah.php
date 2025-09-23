<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAyah extends Model
{
    use HasFactory;

    protected $table = 'data_ayah';

    protected $fillable = [
        'id_peserta','nama','tanggal_lahir','alamat','nik','suku','id_pendidikan','id_pekerjaan','id_penghasilan','no_hp'
    ];

    protected $casts = ['tanggal_lahir'=>'date'];

    public function peserta()
    {
        return $this->belongsTo(DataPeserta::class,'id_peserta');
    }

    public function pendidikan()
    {
        return $this->belongsTo(MasterPendidikanOrtu::class,'id_pendidikan');
    }

    public function pekerjaan()
    {
        return $this->belongsTo(MasterPekerjaanOrtu::class,'id_pekerjaan');
    }

    public function penghasilan()
    {
        return $this->belongsTo(MasterPenghasilanOrtu::class,'id_penghasilan');
    }
}
