<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return view('student.students.index', [
            'title' => 'Profil Mahasiswa',
            'students' => Student::withCount('organizations', 'achievements')
                ->with('organizations', 'coreTeam')
                ->options(request(Student::$allowedParams))
                ->paginate($this->validateAndGetLimit(request('limit'), 10)),
            'sortables' => Student::$sortables,
            'allowedParams' => Student::$allowedParams,
        ]);
    }

    public function show(Student $student)
    {
        return view('student.students.show', [
            'title' => 'Detail Mahasiswa',
            'student' => $student,
        ]);
    }
}
