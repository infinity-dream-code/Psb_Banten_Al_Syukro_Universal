<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        'peserta_id','provider','va_number','prefix','invoice_number','amount','paid_amount','currency','status','paid_at'
    ];

    protected $casts = [
        'amount'=>'decimal:2',
        'paid_amount'=>'decimal:2',
        'paid_at'=>'datetime'
    ];

    public function peserta()
    {
        return $this->belongsTo(DataPeserta::class,'peserta_id');
    }

    public function rincian()
    {
        return $this->hasMany(RincianPembayaran::class,'id_pembayaran');
    }
}
