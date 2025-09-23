<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterKecamatan extends Model
{
    use HasFactory;

    protected $table = 'pmb_ref_kecamatans';
    protected $fillable = ['kecamatan', 'pmb_ref_kota_id', 'id_wil', 'id_wilkot'];
    public $timestamps = false;

    public function kabupaten()
    {
        return $this->belongsTo(MasterKabupaten::class, 'pmb_ref_kota_id');
    }
}
