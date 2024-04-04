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
                'name' => 'Alvin Tanuwijaya',
                'username' => 'Alvin',
                'password' => Hash::make('126912'),
                'role' => 'admin',
                'phone' => '0',
                'email' => '',
            ],

            [
                'name' => 'Nurmayanti',
                'username' => 'NUR',
                'password' => Hash::make('alma'),
                'role' => 'hrd',
                'phone' => '0',
                'email' => '',
            ],

            [
                'name' => 'RAHMAT ADE IRAWAN',
                'username' => 'ADE',
                'password' => Hash::make('rizky'),
                'role' => 'hrd',
                'phone' => '0',
                'email' => '',
            ],

            [
                'name' => 'Ireneus Reni',
                'username' => 'IR',
                'password' => Hash::make('5421'),
                'role' => 'admin',
                'phone' => '0',
                'email' => '',
            ],

            [
                'name' => 'Emanuel Tanuwijaya',
                'username' => 'Ang',
                'password' => Hash::make('123'),
                'role' => 'admin',
                'phone' => '0',
                'email' => '',
            ],

            [
                'name' => 'Yohanes Tan',
                'username' => 'TKC',
                'password' => Hash::make('all'),
                'role' => 'admin',
                'phone' => '0',
                'email' => '',
            ],

            [
                'name' => 'Brian Setiadinata',
                'username' => 'Brian',
                'password' => Hash::make('123'),
                'role' => 'admin',
                'phone' => '0',
                'email' => '',
            ],

            [
                'name' => 'Nugroho',
                'username' => 'Nugroho',
                'password' => Hash::make('123'),
                'role' => 'hrd',
                'phone' => '0',
                'email' => '',
            ],

            [
                'name' => 'Kartika Dewi',
                'username' => 'Tika',
                'password' => Hash::make('7557'),
                'role' => 'hrd',
                'phone' => '0',
                'email' => '',
            ],

            [
                'name' => 'Andjar Boedi Sarwono',
                'username' => 'Andjar',
                'password' => Hash::make('123'),
                'role' => 'hrd',
                'phone' => '0',
                'email' => '',
            ],

            [
                'name' => 'Rodo Natorrang Gultom',
                'username' => 'Rodo',
                'password' => Hash::make('gultom'),
                'role' => 'hrd',
                'phone' => '0',
                'email' => '',
            ],

            [
                'name' => 'Herlambang Yudha',
                'username' => 'Yudha',
                'password' => Hash::make('123'),
                'role' => 'admin',
                'phone' => '0',
                'email' => '',
            ],

            [
                'name' => 'Felix Jesse',
                'username' => 'felixjesse',
                'password' => Hash::make('123'),
                'role' => 'admin',
                'phone' => '0',
                'email' => '',
            ],

            [
                'name' => 'AHMAD RIZKI',
                'username' => 'rizki',
                'password' => Hash::make('123'),
                'role' => 'admin',
                'phone' => '0',
                'email' => '',
            ],


        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
