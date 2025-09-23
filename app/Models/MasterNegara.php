<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterNegara extends Model
{
    protected $table = 'pmb_ref_negaras';
    protected $fillable = ['negara'];
    public $timestamps = false;
}
