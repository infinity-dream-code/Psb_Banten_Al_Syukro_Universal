<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RincianPembayaran extends Model
{
    use HasFactory;

    protected $table = 'rincian_pembayaran';

    protected $fillable = ['id_pembayaran','deskripsi','qty','harga','subtotal'];

    protected $casts = ['harga'=>'decimal:2','subtotal'=>'decimal:2'];

    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class,'id_pembayaran');
    }
}
