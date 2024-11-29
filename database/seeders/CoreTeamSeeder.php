<?php

namespace Database\Seeders;

use App\Models\CoreTeam;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoreTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CoreTeam::insert([
            ['position' => 'Ketua', 'student_id' => null, 'order' => 1],
            ['position' => 'Wakil Ketua', 'student_id' => null, 'order' => 2],
            ['position' => 'Sekretaris 1', 'student_id' => null, 'order' => 3],
            ['position' => 'Sekretaris 2', 'student_id' => null, 'order' => 4],
            ['position' => 'Bendahara 1', 'student_id' => null, 'order' => 5],
            ['position' => 'Bendahara 2', 'student_id' => null, 'order' => 6],
        ]);
    }
}
