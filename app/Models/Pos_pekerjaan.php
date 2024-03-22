<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pos_pekerjaan extends Model
{
    use HasFactory;
    protected $table = 'daftar_pospekerjaan';
    protected $fillable = [
        'entitas',
        'type',
        'desc',
        'dibuat',
    ];
}
