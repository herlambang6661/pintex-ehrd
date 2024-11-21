<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenerimaanLamaranModel extends Model
{
    use HasFactory;
    protected $table = 'penerimaan_lamaran'; // Nama tabel di database
    protected $primaryKey = 'id'; // Primary key, secara default Laravel menggunakan 'id'

    // Kolom yang boleh diisi secara mass-assignment
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

    // Jika Anda ingin menambahkan relasi dengan model KandidatModel
    public function kandidat()
    {
        return $this->belongsTo(KandidatModel::class, 'nik', 'ktp'); // Asumsi kolom nik di penerimaan_lamaran berhubungan dengan kolom ktp di users
    }
}
