<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        return view('student.about.index', [
            'title' => 'Tentang PTI',
        ]);
    }
}
