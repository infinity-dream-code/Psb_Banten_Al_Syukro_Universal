<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPendidikanOrtu extends Model
{
    use HasFactory;

    protected $table = 'master_pendidikan_ortu';

    protected $fillable = ['nama'];
}
