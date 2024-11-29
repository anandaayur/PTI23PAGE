<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('student.contact.index', [
            'title' => 'Kontak PTI 2023',
        ]);
    }
}
