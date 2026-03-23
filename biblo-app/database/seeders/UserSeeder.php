<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Cedric',
                'email' => 'cedric@example.com',
                'password' => Hash::make('12345678'),
                'photo' => 'default.png',
                'coins' => 100,
            ],
            [
                'name' => 'Selena',
                'email' => 'selena@example.com',
                'password' => Hash::make('12345678'),
                'photo' => 'default.png',
                'coins' => 250,
            ],
            [
                'name' => 'Aileen',
                'email' => 'aileen@example.com',
                'password' => Hash::make('12345678'),
                'photo' => 'default.png',
                'coins' => 500,
            ],
            [
                'name' => 'Mikael',
                'email' => 'mikael@example.com',
                'password' => Hash::make('12345678'),
                'photo' => 'default.png',
                'coins' => 500,
            ],
        ]);
    }
}