<?php

namespace Database\Seeders;

use App\Models\daftar_entitas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EntitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'singkatan' => 'PINTEX',
                'nama' => 'PT. Plumbon International Textile',
                'alamat' => 'Cirebon',
                'remember_token' => '0',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'singkatan' => 'TFI',
                'nama' => 'PT. Tantra Fiber Industry',
                'alamat' => 'Cirebon',
                'remember_token' => '0',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        foreach ($user as $key => $value) {
            daftar_entitas::create($value);
        }
    }
}
