<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lamaran extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'entitas',
        'nik',
        'nama',
        'gender',
        'tempat',
        'tgllahir',
        'pendidikan',
        'jurusan',
        'alamat',
        'agama',
        'tinggi',
        'berat',
        'notlp',
        'posisi',
        'email',
        'keterangan',
        'dibuat',
    ];
}
