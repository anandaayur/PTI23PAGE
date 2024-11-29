<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkingProgramRequest;
use App\Http\Requests\UpdateWorkingProgramRequest;
use App\Models\CoreTeam;
use App\Models\WorkingProgram;
use Illuminate\Http\Request;

class WorkingProgramController extends Controller
{
    public function index()
    {
        return view('dashboard.working-programs.index', [
            'title' => 'Daftar Program Kerja',
            'workingPrograms' => WorkingProgram::with('coreTeam')
                ->options(request(WorkingProgram::$allowedParams))
                ->paginate($this->validateAndGetLimit(request('limit'), 10)),
            'coreTeams' => CoreTeam::orderBy('order')->get(),
            'sortables' => WorkingProgram::$sortables,
            'allowedParams' => WorkingProgram::$allowedParams,
        ]);
    }

    public function store(StoreWorkingProgramRequest $request)
    {
        $data = $request->validated();
        WorkingProgram::create($data);
        return redirect()->back()->with('success', 'Program kerja berhasil ditambahkan');
    }

    public function edit(WorkingProgram $workingProgram)
    {
        return view('dashboard.working-programs.edit', [
            'title' => 'Ubah Program Kerja',
            'workingProgram' => $workingProgram,
            'coreTeams' => CoreTeam::orderBy('order')->get(),
        ]);
    }

    public function update(UpdateWorkingProgramRequest $request, WorkingProgram $workingProgram)
    {
        $data = $request->validated();
        $workingProgram->update($data);
        return redirect($request->previous_url ?? route('admin.dashboard.working-programs.index'))->with('success', 'Program kerja berhasil diubah');
    }

    public function destroy(WorkingProgram $workingProgram)
    {
        $workingProgram->delete();
        return redirect()->back()->with('success', 'Program kerja berhasil dihapus');
    }
}
