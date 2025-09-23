<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bayar extends Model
{
    use HasFactory;

    protected $table = 'bayar';

    protected $fillable = ['nama_pembayaran'];

    public function pembayaranSekolah()
    {
        return $this->hasMany(PembayaranSekolah::class,'id_bayar');
    }
}
