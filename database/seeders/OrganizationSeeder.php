<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Organization::insert([
            ['name' => 'BEM FILKOM'],
            ['name' => 'DPM FILKOM'],
            ['name' => 'KBMDSI'],
            ['name' => 'BIOS'],
            ['name' => 'BCC'],
            ['name' => 'RAION'],
        ]);
    }
}
