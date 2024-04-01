<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Shift extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'entitas' => 'PINTEX',
                'shift' => 'Day-Shift',
                'jenis' => 'Shift-0',
                'in'    => '08:00:00',
                'out'   => '16:00:00',
                'keterangan' => '(08:00 - 16:00)',
                'in_rest'   => '12:00:00',
                'out_rest' => '13:00:00',
            ],
            [
                'entitas' => 'PINTEX',
                'shift' => 'Shift',
                'jenis' => 'Shift-1',
                'in'    => '06:00:00',
                'out'   => '14:00:00',
                'keterangan' => '(06:00 - 14:00)',
                'in_rest'   => '09:00:00',
                'out_rest' => '12:00:00',
            ],
            [
                'entitas' => 'PINTEX',
                'shift' => 'Shift',
                'jenis' => 'Shift-2',
                'in'    => '14:00:00',
                'out'   => '22:00:00',
                'keterangan' => '(14:00 - 22:00)',
                'in_rest'   => '17:00:00',
                'out_rest' => '20:00:00',
            ],
            [
                'entitas' => 'PINTEX',
                'shift' => 'Shift',
                'jenis' => 'Shift-3',
                'in'    => '22:00:00',
                'out'   => '06:00:00',
                'keterangan' => '(22:00 - 06:00)',
                'in_rest'   => '01:00:00',
                'out_rest' => '03:00:00',
            ],
        ];
        foreach ($user as $key => $value) {
            DB::table('daftar_shift')->insert($value);
        }
    }
}
