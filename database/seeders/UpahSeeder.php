<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UpahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $upah = [
            [
                'entitas' => 'PINTEX',
                'jenis' => 'gapok',
                'nominal' => '2517730',
            ],
            [
                'entitas' => 'PINTEX',
                'jenis' => 'bpjs_jkk',
                'nominal' => '0',
            ],
            [
                'entitas' => 'PINTEX',
                'jenis' => 'bpjs_jkm',
                'nominal' => '0',
            ],
            [
                'entitas' => 'PINTEX',
                'jenis' => 'bpjs_jp',
                'nominal' => '0',
            ],
            [
                'entitas' => 'PINTEX',
                'jenis' => 'bpjs_jht',
                'nominal' => '0',
            ],
            [
                'entitas' => 'PINTEX',
                'jenis' => 'bpjs_ks',
                'nominal' => '0',
            ],
        ];
        foreach ($upah as $key => $value) {
            DB::table('daftar_upah')->insert($value);
        }
    }
}
