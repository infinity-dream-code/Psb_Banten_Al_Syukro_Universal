<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterJurusanSekolah extends Model
{
    use HasFactory;

    protected $table = 'master_jurusan_sekolah';

    protected $fillable = ['nama'];
}
