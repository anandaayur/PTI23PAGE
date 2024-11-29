<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLecturerRequest;
use App\Http\Requests\UpdateLecturerRequest;
use App\Models\Lecturer;

class LecturerController extends Controller
{
    public function index()
    {
        return view('dashboard.lecturers.index', [
            'title' => 'Daftar Dosen',
            'lecturers' => Lecturer::options(request(Lecturer::$allowedParams))
                ->paginate($this->validateAndGetLimit(request('limit'), 10)),
            'sortables' => Lecturer::$sortables,
            'allowedParams' => Lecturer::$allowedParams,
        ]);
    }

    public function store(StoreLecturerRequest $request)
    {
        $data = $request->validated();
        Lecturer::create($data);
        return redirect()->back()->with('success', 'Dosen berhasil ditambahkan');
    }

    public function edit(Lecturer $lecturer)
    {
        return view('dashboard.lecturers.edit', [
            'title' => 'Ubah Dosen',
            'lecturer' => $lecturer,
        ]);
    }

    public function update(UpdateLecturerRequest $request, Lecturer $lecturer)
    {
        $data = $request->validated();
        $lecturer->update($data);
        return redirect($request->previous_url ?? route('admin.dashboard.lecturers.index'))->with('success', 'Dosen berhasil diubah');
    }

    public function destroy(Lecturer $lecturer)
    {
        $lecturer->delete();
        return redirect()->back()->with('success', 'Dosen berhasil dihapus');
    }
}
