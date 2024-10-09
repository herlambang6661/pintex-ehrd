<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loker extends Model
{
    use HasFactory;

    protected $table = 'penerimaan_lowongan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'entitas',
        'unlimited',
        'tgl_buka',
        'tgl_tutup',
        'posisi',
        'pendidikan',
        'sima',
        'simb',
        'simb2',
        'sio',
        'deskripsi',
        'release',
    ];
}
