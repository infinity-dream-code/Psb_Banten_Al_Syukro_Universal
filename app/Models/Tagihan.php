<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    protected $table = 'tagihan';

    protected $fillable = [
        'id_peserta',
        'biaya_daful',
        'detail',
        'status',
        'tanggal_pembayaran_daful',
    ];

    protected $casts = [
        'detail' => 'array',
        'status' => 'integer',
        'tanggal_pembayaran_daful' => 'datetime',
    ];

    public function peserta()
    {
        return $this->belongsTo(DataPeserta::class, 'id_peserta');
    }
}
