<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterUjian extends Model
{
    use HasFactory;

    protected $table = 'master_ujian';
    protected $fillable = ['nama'];

    public function ujians()
    {
        return $this->hasMany(Ujian::class, 'id_master_ujian');
    }
}
