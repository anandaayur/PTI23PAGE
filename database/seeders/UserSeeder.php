<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Rafi Rahman',
                'email' => 'rafirahmann18@gmail.com',
                'password' => bcrypt('123456'),
                'avatar_url' => null,
                'role' => 'admin'
            ],
            [
                'name' => 'Administrator',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456'),
                'avatar_url' => null,
                'role' => 'admin'
            ]
        ]);
    }
}
