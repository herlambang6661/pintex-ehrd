<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KandidatModel extends Model
{
    use HasFactory;

    protected $connection = 'mysql_karir';
    protected $table = "users";

    protected $fillable = [
        'userid',
        'ktp',
        'namaLengkap',
        'email',
        'active',
        'email_verified_at',
        'notlp',
        'gender',
        'tempat',
        'tglLahir',
        'alamat',
        'agama',
        'tinggi',
        'berat',
        'pendidikan',
        'sekolah',
        'jurusan',
        'password',
        'forgetPassword',
        'passwordForget',
        'foto_pas',
        'foto_ktp',
        'foto_kk',
        'foto_ijazah',
        'foto_suratsehat',
        'foto_vaksin',
        'file_cv',
        'file_pengalaman',
        'referensi',
        'kerabat',
        'remember_token',
        'created_at',
        'updated_at',
    ];

    // KandidatModel.php
    public function penerimaanLamaran()
    {
        return $this->hasOne(PenerimaanLamaranModel::class, 'userid', 'userid');
    }
}
