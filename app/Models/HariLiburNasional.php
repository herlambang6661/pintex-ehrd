<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HariLiburNasional extends Model
{
    use HasFactory;
    protected $table = 'hari_libur_nasional';
    protected $fillable = [
        'tanggal',
        'libur_nasional',
        'sumber_ketentuan',
        'keterangan',
    ];
}
