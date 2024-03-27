<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarif_lembur extends Model
{
    use HasFactory;
    protected $table = 'tarif_lembur';
    protected $fillable = [
        'entitas',
        'basis',
        'level',
        'kjk',
        'insidentil',
    ];
}
