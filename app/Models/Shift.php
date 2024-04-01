<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;
    protected $table = 'daftar_shift';
    protected $fillable = [
        'entitas',
        'shift',
        'jenis',
        'in',
        'out',
        'keterangan',
        'in_rest',
        'out_rest',
    ];
}
