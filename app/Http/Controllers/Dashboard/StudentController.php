<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Lecturer;
use App\Models\Organization;
use App\Models\Student;
use App\Models\StudentOrganizationPivot;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return view('dashboard.students.index', [
            'title' => 'Daftar Mahasiwa',
            'students' => Student::with('lecturer')
                ->options(request(Student::$allowedParams))
                ->paginate($this->validateAndGetLimit(request('limit'), 10)),
            'lecturers' => Lecturer::all(),
            'organizations' => Organization::all(),
            'sortables' => Student::$sortables,
            'allowedParams' => Student::$allowedParams,
        ]);
    }

    public function show(Student $student)
    {
        return view('dashboard.students.show', [
            'title' => 'Detail Mahasiswa',
            'student' => $student,
        ]);
    }

    public function store(StoreStudentRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $data['photo_url'] = $this->storeImage($request->file('photo'), 'students');
        }

        $student = Student::create($data);

        if ($request->organization_ids) {
            StudentOrganizationPivot::multipleInsert($request->organization_ids, $student->id);
        }
        return redirect()->back()->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    public function edit(Student $student)
    {
        return view('dashboard.students.edit', [
            'title' => 'Ubah Mahasiswa',
            'student' => $student,
            'lecturers' => Lecturer::all(),
            'organizations' => Organization::all(),
        ]);
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            if ($student->photo) {
                $this->deleteFile($student->photo);
            }

            $data['photo_url'] = $this->storephoto($request->file('photo'), 'students');
        } else {
            $this->deleteFile($student->photo);
            $data['photo_url'] = null;
        }

        StudentOrganizationPivot::where('student_id', $student->id)->delete();
        if ($request->organization_ids) {
            StudentOrganizationPivot::multipleInsert($request->organization_ids, $student->id);
        }

        $student->update($data);

        return redirect($request->previous_url ?? route('admin.dashboard.students.index'))->with('success', 'Mahasiswa berhasil diubah');
    }

    public function destroy(Student $student)
    {
        $this->deleteFile($student->photo_url);
        $student->delete();
        return redirect()->back()->with('success', 'Mahasiswa berhasil dihapus');
    }
}
