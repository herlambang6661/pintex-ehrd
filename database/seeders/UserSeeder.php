<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'name' => 'Administrator',
                'username' => 'admin',
                'password' => Hash::make('hashclaw137'),
                'role' => 'admin',
                'phone' => '0',
                'email' => 'IT@pintex.co.id',
            ],
            [
                'name' => 'Puji Nurrenti',
                'username' => 'puji',
                'password' => Hash::make('260897'),
                'role' => 'purchasing',
                'phone' => '0',
                'email' => 'puji@pintex.co.id',
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
