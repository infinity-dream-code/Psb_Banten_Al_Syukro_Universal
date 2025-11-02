<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterRole extends Model
{
    use HasFactory;
     protected $table = 'master_role';

    protected $fillable = [
        'nama_role',
        'menu',
    ];

    protected $casts = [
        'menu' => 'array',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
