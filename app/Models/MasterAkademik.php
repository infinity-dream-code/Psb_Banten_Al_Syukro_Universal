<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterAkademik extends Model
{
    use HasFactory;

    protected $table = 'master_akademik';

    protected $fillable = [
        'tahun_akademik',
        'tahun_mulai',
        'tahun_selesai',
        'is_active',
    ];
}
