<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterKabupaten extends Model
{
    use HasFactory;

    protected $table = 'pmb_ref_kotas';
    protected $fillable = ['kota', 'pmb_ref_provinsi_id', 'id_wil'];
    public $timestamps = false;

    public function provinsi()
    {
        return $this->belongsTo(MasterProvinsi::class, 'pmb_ref_provinsi_id');
    }

    public function kecamatan()
    {
        return $this->hasMany(MasterKecamatan::class, 'pmb_ref_kota_id', 'id');
    }
}
