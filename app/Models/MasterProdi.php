<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterProdi extends Model
{
    use HasFactory;

    protected $table = 'master_prodi';

    protected $fillable = ['id_fakultas','nama'];

     public function targets()
    {
        return $this->hasMany(Target::class, 'id_prodi');
    }

     public function latestTarget()
    {
        return $this->hasOne(Target::class, 'id_prodi', 'id')->latestOfMany();
    }

    public function fakultas()
    {
        return $this->belongsTo(MasterFakultas::class,'id_fakultas');
    }

    public function pembayaranSekolah()
    {
        return $this->hasMany(PembayaranSekolah::class,'id_prodi');
    }


    public function peserta()
    {
        return $this->hasMany(DataPeserta::class,'id_prodi');
    }

    
}
