<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daftar_users extends Model
{
    use HasFactory;
    protected $table = 'daftar_users';
    protected $fillable = [
        'name',
        'group',
        'level',
    ];
}
