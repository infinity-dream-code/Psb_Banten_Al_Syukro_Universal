<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user';

    protected $fillable = [
        'nama',
        'username',
        'password',
        'plain_password',
        'role',
        'prodi_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function peserta()
    {
        return $this->hasOne(DataPeserta::class, 'id_user');
    }

    public function prodi()
    {
        return $this->belongsTo(MasterProdi::class, 'prodi_id');
    }
}
