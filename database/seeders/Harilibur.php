<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Harilibur extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'entitas' => 'PINTEX',
                'tanggal' => '2024-02-13',
                'libur_nasional' => 'Hari Raya Idul Fitri',
                'sumber_ketentuan' => 'Libur Nasional',
                'keterangan' => 'Libur'
            ],
        ];
        foreach ($user as $key => $value) {
            DB::table('daftar_hari_libur_nasional')->insert($value);
        }
    }
}
