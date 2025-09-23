<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    protected $table = 'target';

    protected $fillable = [
        'id_prodi',
        'target',
    ];

    public function prodi()
    {
        return $this->belongsTo(MasterProdi::class, 'id_prodi');
    }
}
