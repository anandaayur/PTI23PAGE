<?php

namespace Database\Seeders;

use App\Models\Lecturer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LecturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lecturer::insert([
            ['name' => 'Dr. Budi Santoso', 'email' => 'budi@ub.ac.id'],
            ['name' => 'Dr. Agus Pranoto', 'email' => 'agus@ub.ac.id'],
            ['name' => 'Dr. Nurul Hidayah', 'email' => 'nurul@ub.ac.id'],
            ['name' => 'Dr. Siti Rahmawati', 'email' => 'siti@ub.ac.id'],
            ['name' => 'Dr. Ahmad Zainudin', 'email' => 'ahmad@ub.ac.id'],
            ['name' => 'Dr. Okta Purnawan', 'email' => 'okta@ub.ac.id'],
            ['name' => 'Dr. Rista Putri', 'email' => 'rista@ub.ac.id'],
        ]);
    }
}
