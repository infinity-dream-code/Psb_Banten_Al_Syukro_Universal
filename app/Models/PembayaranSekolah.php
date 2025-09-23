<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranSekolah extends Model
{
    use HasFactory;

    protected $table = 'pembayaran_sekolah';

    protected $fillable = [
        'id_prodi','id_bayar','id_jalur','pos','nominal','tagih_saat_regis','diskon_by_jalur','is_active'
    ];

    protected $casts = [
        'nominal'=>'decimal:2',
        'diskon_by_jalur'=>'decimal:2',
        'tagih_saat_regis'=>'boolean',
        'is_active'=>'boolean'
    ];

    public function prodi()
    {
        return $this->belongsTo(MasterProdi::class,'id_prodi');
    }

    public function bayar()
    {
        return $this->belongsTo(Bayar::class,'id_bayar');
    }

    public function jalur()
    {
        return $this->belongsTo(MasterJalur::class,'id_jalur');
    }

    public function gelombang()
    {
        return $this->belongsTo(MasterGelombang::class,'id_gelombang');
    }
}
