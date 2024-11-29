<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCoreTeamRequest;
use App\Http\Requests\UpdateCoreTeamRequest;
use App\Models\CoreTeam;
use App\Models\Student;
use Illuminate\Http\Request;

class CoreTeamController extends Controller
{
    public function index()
    {
        return view('dashboard.core-teams.index', [
            'title' => 'Daftar Pengurus Inti',
            'coreTeams' => CoreTeam::with('workingPrograms', 'student')
                ->options(request(CoreTeam::$allowedParams))
                ->paginate($this->validateAndGetLimit(request('limit'), 10)),
            'students' => Student::getStudentNotInCoreTeam(),
            'sortables' => CoreTeam::$sortables,
            'allowedParams' => CoreTeam::$allowedParams,
        ]);
    }

    public function store(StoreCoreTeamRequest $request)
    {
        $data = $request->validated();
        CoreTeam::create($data);
        return redirect()->back()->with('success', 'Pengurus Inti berhasil ditambahkan');
    }

    public function edit(CoreTeam $coreTeam)
    {
        return view('dashboard.core-teams.edit', [
            'title' => 'Ubah Pengurus Inti',
            'coreTeam' => $coreTeam,
            'students' => Student::getStudentNotInCoreTeam($coreTeam->student_id),
        ]);
    }

    public function update(UpdateCoreTeamRequest $request, CoreTeam $coreTeam)
    {
        $data = $request->validated();
        $coreTeam->update($data);
        return redirect($request->previous_url ?? route('admin.dashboard.core-teams.index'))->with('success', 'Pengurus inti berhasil diubah');
    }

    public function destroy(CoreTeam $coreTeam)
    {
        $coreTeam->delete();
        return redirect()->back()->with('success', 'Pengurus inti berhasil dihapus');
    }
}
