<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenerimaanLamaranModel extends Model
{
    use HasFactory;
    protected $table = 'penerimaan_lamaran';
    protected $primaryKey = 'id';

    protected $fillable = [
        'entitas',
        'nik',
        'stb',
        'nama',
        'gender',
        'tempat',
        'tgllahir',
        'sekolah',
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
        'wawancara',
        'noformwawancara',
        'diterima',
        'tglinput',
        'dibuat',
        'remember_token',
    ];

    public function kandidat()
    {
        return $this->belongsTo(KandidatModel::class, 'nik', 'ktp');
    }
}
