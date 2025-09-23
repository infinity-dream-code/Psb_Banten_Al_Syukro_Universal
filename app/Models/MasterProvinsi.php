<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterProvinsi extends Model
{
    use HasFactory;

    protected $table = 'pmb_ref_provinsis';

    protected $fillable = ['Provinsi', 'pmb_ref_negara_id', 'id_wil'];

    public $timestamps = false;

    public function negara()
    {
        return $this->belongsTo(MasterNegara::class, 'pmb_ref_negara_id');
    }

   public function kabupaten()
{
    return $this->hasMany(MasterKabupaten::class, 'pmb_ref_provinsi_id', 'id');
}

}
