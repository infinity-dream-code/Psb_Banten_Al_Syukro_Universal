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

    public function homePath(): string
    {
        if ($this->role === 'admin') {
            return '/pages/display/home';
        }

        if ($this->role === 'peserta') {
            return '/pages/dashboard';
        }

        return '/pages/display/home/' . \Illuminate\Support\Str::slug((string) $this->role, '-');
    }

    public function peserta()
    {
        return $this->hasOne(DataPeserta::class, 'id_user');
    }

    public function prodi()
    {
        return $this->belongsTo(MasterProdi::class, 'prodi_id');
    }
}
