<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PekerjaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'entitas' => 'PINTEX',
                'type' => 'DIVISI', 'desc' => 'HRD & GA',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'entitas' => 'PINTEX',
                'type' => 'DIVISI', 'desc' => 'PRODUKSI',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'entitas' => 'PINTEX',
                'type' => 'BAGIAN', 'desc' => 'AKUNTING & KEUANGAN',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'entitas' => 'PINTEX',
                'type' => 'BAGIAN', 'desc' => 'GUDANG 1',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'entitas' => 'PINTEX',
                'type' => 'BAGIAN', 'desc' => 'GUDANG 2',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'entitas' => 'PINTEX',
                'type' => 'BAGIAN', 'desc' => 'KEAMANAN',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'entitas' => 'PINTEX',
                'type' => 'BAGIAN', 'desc' => 'KEBERSIHAN',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'entitas' => 'PINTEX',
                'type' => 'BAGIAN', 'desc' => 'PEMBELIAN',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'entitas' => 'PINTEX',
                'type' => 'BAGIAN', 'desc' => 'PERSONALIA',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'entitas' => 'PINTEX',
                'type' => 'BAGIAN', 'desc' => 'UMUM',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'entitas' => 'PINTEX',
                'type' => 'BAGIAN', 'desc' => 'UNIT 1',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'entitas' => 'PINTEX',
                'type' => 'BAGIAN', 'desc' => 'UNIT 2',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'entitas' => 'PINTEX',
                'type' => 'JABATAN', 'desc' => 'ANGGOTA',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'entitas' => 'PINTEX',
                'type' => 'JABATAN', 'desc' => 'KABAG',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'entitas' => 'PINTEX',
                'type' => 'JABATAN', 'desc' => 'KAPOK',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'entitas' => 'PINTEX',
                'type' => 'JABATAN', 'desc' => 'KARU',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'entitas' => 'PINTEX',
                'type' => 'JABATAN', 'desc' => 'KASIE',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'entitas' => 'PINTEX',
                'type' => 'JABATAN', 'desc' => 'KOORDINATOR',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'entitas' => 'PINTEX',
                'type' => 'JABATAN', 'desc' => 'MANAGER',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'entitas' => 'PINTEX',
                'type' => 'JABATAN', 'desc' => 'STAFF',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'entitas' => 'PINTEX',
                'type' => 'JABATAN', 'desc' => 'WAKIL KOORDINATOR',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'entitas' => 'PINTEX',
                'type' => 'GRUP', 'desc' => 'A',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'entitas' => 'PINTEX',
                'type' => 'GRUP', 'desc' => 'B',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'entitas' => 'PINTEX',
                'type' => 'GRUP', 'desc' => 'C',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'entitas' => 'PINTEX',
                'type' => 'GRUP', 'desc' => 'NON GRUP',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'entitas' => 'PINTEX',
                'type' => 'SHIFT', 'desc' => 'NON SHIFT',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'entitas' => 'PINTEX',
                'type' => 'SHIFT', 'desc' => 'SHIFT',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'entitas' => 'PINTEX',
                'type' => 'BAGIAN', 'desc' => 'KARTAP',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'entitas' => 'PINTEX',
                'type' => 'GRUP', 'desc' => 'MTC',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'entitas' => 'PINTEX',
                'type' => 'GRUP', 'desc' => 'OPD',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'entitas' => 'PINTEX',
                'type' => 'GRUP', 'desc' => 'PPC/QC',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'entitas' => 'PINTEX',
                'type' => 'BAGIAN', 'desc' => 'WCR & WORKSHOP',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'entitas' => 'PINTEX',
                'type' => 'JABATAN', 'desc' => 'DANRU',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'entitas' => 'PINTEX',
                'type' => 'JABATAN', 'desc' => 'WAKIL DANRU',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'entitas' => 'PINTEX',
                'type' => 'BAGIAN', 'desc' => 'TFO 1',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'entitas' => 'PINTEX',
                'type' => 'BAGIAN', 'desc' => 'TFO 2',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'entitas' => 'PINTEX',
                'type' => 'BAGIAN', 'desc' => 'INT',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'entitas' => 'PINTEX',
                'type' => 'BAGIAN',
                'desc' => 'TFI',
                'dibuat' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

        ];

        foreach ($user as $key => $value) {
            DB::table('daftar_pospekerjaan')->insert($value);
        }
    }
}
