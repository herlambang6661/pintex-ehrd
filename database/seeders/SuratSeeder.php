<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'entitas' => 'PINTEX',
                'jenissurat' => 'Basic',
                'nmsurat' => 'Surat Deskripsi Pekerjaan',
                'nilai' => '',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'entitas' => 'PINTEX',
                'jenissurat' => 'Intern',
                'nmsurat' => 'Surat Pernyataan',
                'nilai' => '',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'entitas' => 'PINTEX',
                'jenissurat' => 'Intern',
                'nmsurat' => 'Surat Peringatan (SP)',
                'nilai' => '',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'entitas' => 'PINTEX',
                'jenissurat' => 'Intern',
                'nmsurat' => 'Status',
                'nilai' => '',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'entitas' => 'PINTEX',
                'jenissurat' => 'Intern',
                'nmsurat' => 'Nota Dalam',
                'nilai' => '',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'entitas' => 'PINTEX',
                'jenissurat' => 'Intern',
                'nmsurat' => 'Surat Teguran',
                'nilai' => '',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'entitas' => 'PINTEX',
                'jenissurat' => 'Intern',
                'nmsurat' => 'Demosi',
                'nilai' => '',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'entitas' => 'PINTEX',
                'jenissurat' => 'Intern',
                'nmsurat' => 'Promosi',
                'nilai' => '',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'entitas' => 'PINTEX',
                'jenissurat' => 'Komunikasi',
                'nmsurat' => 'Keputusan-Mgr. Cuti',
                'nilai' => 'C',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'entitas' => 'PINTEX',
                'jenissurat' => 'Komunikasi',
                'nmsurat' => 'Surat Izin Keluar Pabrik',
                'nilai' => 'H',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'entitas' => 'PINTEX',
                'jenissurat' => 'Komunikasi',
                'nmsurat' => 'Formulir Izin Tidak Masuk Karena Sakit',
                'nilai' => 'S',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'entitas' => 'PINTEX',
                'jenissurat' => 'Komunikasi',
                'nmsurat' => 'Surat Geser/Tukar Libur',
                'nilai' => 'L',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'entitas' => 'PINTEX',
                'jenissurat' => 'Komunikasi',
                'nmsurat' => 'Surat Perintah Lembur',
                'nilai' => 'H',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'entitas' => 'PINTEX',
                'jenissurat' => 'Komunikasi',
                'nmsurat' => 'Formulir Permohonan Cuti',
                'nilai' => 'C',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'entitas' => 'PINTEX',
                'jenissurat' => 'Komunikasi',
                'nmsurat' => 'Keputusan-Mgr. Hadir',
                'nilai' => 'H',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'entitas' => 'PINTEX',
                'jenissurat' => 'Komunikasi',
                'nmsurat' => 'Keputusan-Mgr. Libur',
                'nilai' => 'L',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'entitas' => 'PINTEX',
                'jenissurat' => 'Komunikasi',
                'nmsurat' => 'Keputusan-Mgr. Alpa',
                'nilai' => 'A',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'entitas' => 'PINTEX',
                'jenissurat' => 'Komunikasi',
                'nmsurat' => 'Keputusan-Mgr. Sakit',
                'nilai' => 'S',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'entitas' => 'PINTEX',
                'jenissurat' => 'Komunikasi',
                'nmsurat' => 'Surat Izin Setengah Hari',
                'nilai' => '½',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'entitas' => 'PINTEX',
                'jenissurat' => 'Komunikasi',
                'nmsurat' => 'Permohonan Cuti Khusus',
                'nilai' => 'CK',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'entitas' => 'PINTEX',
                'jenissurat' => 'Komunikasi',
                'nmsurat' => 'Keputusan-Mgr. Izin',
                'nilai' => 'I',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'entitas' => 'PINTEX',
                'jenissurat' => 'Perjanjian',
                'nmsurat' => 'Perjanjian Kerja OL',
                'nilai' => 'OL',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'entitas' => 'PINTEX',
                'jenissurat' => 'Perjanjian',
                'nmsurat' => 'Perjanjian Kerja PHL',
                'nilai' => 'PHL',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'entitas' => 'PINTEX',
                'jenissurat' => 'Perjanjian',
                'nmsurat' => 'Perjanjian Kontrak',
                'nilai' => 'Kontrak',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'entitas' => 'PINTEX',
                'jenissurat' => 'Perjanjian',
                'nmsurat' => 'Perjanjian Magang',
                'nilai' => 'Magang',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'entitas' => 'PINTEX',
                'jenissurat' => 'Status',
                'nmsurat' => 'Surat Cuti Melahirkan',
                'nilai' => 'CM',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'entitas' => 'PINTEX',
                'jenissurat' => 'Status',
                'nmsurat' => 'Meninggal Dunia',
                'nilai' => 'Meninggal Dunia',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'entitas' => 'PINTEX',
                'jenissurat' => 'Status',
                'nmsurat' => 'Surat Pengunduran Diri (Resign)',
                'nilai' => 'Resign',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'entitas' => 'PINTEX',
                'jenissurat' => 'Status',
                'nmsurat' => 'Surat Pemutusan Hubungan Kerja (PHK)',
                'nilai' => 'PHK',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'entitas' => 'PINTEX',
                'jenissurat' => 'Status',
                'nmsurat' => 'Surat Keputusan Dirumahkan',
                'nilai' => 'R',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'entitas' => 'PINTEX',
                'jenissurat' => 'Status',
                'nmsurat' => 'Surat Keputusan Kembali Aktif',
                'nilai' => 'Aktif',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'entitas' => 'PINTEX',
                'jenissurat' => 'Status',
                'nmsurat' => 'Surat Keputusan Pensiun',
                'nilai' => 'Pensiun',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'entitas' => 'PINTEX',
                'jenissurat' => 'Status',
                'nmsurat' => 'Habis Kontrak',
                'nilai' => 'Habis Kontrak',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],


        ];

        foreach ($user as $key => $value) {
            DB::table('daftar_surat')->insert($value);
        }
    }
}
