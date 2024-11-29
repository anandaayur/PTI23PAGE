<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\CoreTeam;
use App\Models\Student;
use Illuminate\Http\Request;

class CoreTeamController extends Controller
{
    public function index()
    {
        return view('student.core-teams.index', [
            'title' => 'Pengurus Inti PTI 2023',
            'coreTeams' => CoreTeam::with('student', 'workingPrograms')
                ->where('student_id', '!=', null)
                ->orderBy('order')
                ->get()
        ]);
    }
}
