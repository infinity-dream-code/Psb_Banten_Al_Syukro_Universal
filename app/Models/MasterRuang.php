<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterRuang extends Model
{
    use HasFactory;

    protected $table = 'master_ruang';

    protected $fillable = [
        'ruang',
        'kapasitas',
    ];
}
