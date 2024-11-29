<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAchievementRequest;
use App\Http\Requests\UpdateAchievementRequest;
use App\Models\Achievement;
use App\Models\Student;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    public function index()
    {
        return view('dashboard.achievements.index', [
            'title' => 'Daftar Prestasi',
            'achievements' => Achievement::with('student')
                ->options(request(Achievement::$allowedParams))
                ->paginate($this->validateAndGetLimit(request('limit'), 10)),
            'students' => Student::orderBy('name')->get(),
            'sortables' => Achievement::$sortables,
            'allowedParams' => Achievement::$allowedParams,
        ]);
    }

    public function store(StoreAchievementRequest $request)
    {
        $data = $request->validated();
        Achievement::create($data);
        return redirect()->back()->with('success', 'Prestasi berhasil ditambahkan');
    }

    public function edit(Achievement $achievement)
    {
        return view('dashboard.achievements.edit', [
            'title' => 'Ubah Prestasi',
            'achievement' => $achievement,
        ]);
    }

    public function update(UpdateAchievementRequest $request, Achievement $achievement)
    {
        $data = $request->validated();
        $achievement->update($data);
        return redirect($request->previous_url ?? route('admin.dashboard.achievements.index'))->with('success', 'Prestasi berhasil diubah');
    }

    public function destroy(Achievement $achievement)
    {
        $achievement->delete();
        return redirect()->back()->with('success', 'Prestasi berhasil dihapus');
    }
}
