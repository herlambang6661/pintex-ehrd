<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TarifLemburSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'entitas' => 'PINTEX',
                'basic' => 'ANGGOTA',
                'level' => 'JABATAN',
                'kjk'   => '14.600',
                'insidentil' => '13.200',
            ],
            [
                'entitas' => 'PINTEX',
                'basic' => 'KABAG',
                'level' => 'JABATAN',
            ],
            [
                'entitas' => 'PINTEX',
                'basic' => 'KAPOK',
                'level' => 'JABATAN',
                'kjk'   => '16.200',
                'insidentil' => '14.000',
            ],
            [
                'entitas' => 'PINTEX',
                'basic' => 'KARU',
                'level' => 'JABATAN',
                'kjk'   => '18.900',
                'insidentil' => '14.300',
            ],
            [
                'entitas' => 'PINTEX',
                'basic' => 'KASIE',
                'level' => 'JABATAN',
            ],
            [
                'entitas' => 'PINTEX',
                'basic' => 'KOORDINATOR',
                'level' => 'JABATAN',
                'kjk'   => '21.100',
                'insidentil' => '20.600',
            ],
            [
                'entitas' => 'PINTEX',
                'basic' => 'MANAGER',
                'level' => 'JABATAN',
            ],
            [
                'entitas' => 'PINTEX',
                'basic' => 'STAFF',
                'level' => 'JABATAN',
            ],
            [
                'entitas' => 'PINTEX',
                'basic' => 'WAKIL KOORDINATOR',
                'level' => 'JABATAN',
                'kjk'   => '19.500',
                'insidentil' => '19.400',
            ],
            [
                'entitas' => 'PINTEX',
                'basic' => 'DANRU',
                'level' => 'JABATAN',
            ],
            [
                'entitas' => 'PINTEX',
                'basic' => 'WAKIL DANRU',
                'level' => 'JABATAN',
                'kjk'   => '18.900',
                'insidentil' => '18.400',
            ],

        ];

        foreach ($user as $key => $value) {
            DB::table('daftar_tarif_lembur')->insert($value);
        }
    }
}
