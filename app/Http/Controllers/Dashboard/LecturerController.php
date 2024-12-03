<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLecturerRequest;
use App\Http\Requests\UpdateLecturerRequest;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Lecturer;


class LecturerController extends Controller
{

    public function index()
    {
        // Fetch lecturers from the external API
        $response = Http::get('http://127.0.0.1:8002/api/lecturer');

        // Check if the request was successful
        if ($response->successful()) {
            $lecturersData = $response->json()['data']; // Get 'data' from the API response
        } else {
            $lecturersData = []; // If the API request fails, return an empty array
        }

        // Simulate pagination
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10; // Items per page
        $currentItems = array_slice($lecturersData, ($currentPage - 1) * $perPage, $perPage); // Slice data for the current page

        // Create a LengthAwarePaginator instance for pagination
        $lecturers = new LengthAwarePaginator(
            $currentItems, // Items on current page
            count($lecturersData), // Total number of items
            $perPage, // Items per page
            $currentPage, // Current page number
            ['path' => LengthAwarePaginator::resolveCurrentPath(), 'query' => request()->query()] // Ensure query params are preserved
        );

        // Return the view with necessary data
        return view('dashboard.lecturers.index', [
            'title' => 'Daftar Dosen',
            'lecturers' => $lecturers,
            'sortables' => Lecturer::$sortables,
            'allowedParams' => Lecturer::$allowedParams,
        ]);
    }

    public function store(StoreLecturerRequest $request)
    {
        $data = $request->validated();

        // Send POST request to the API to store the lecturer data
        $response = Http::post('http://127.0.0.1:8002/api/lecturer', $data);

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Dosen berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan dosen');
        }
    }


    public function edit($id)
    {
        // Send GET request to fetch the lecturer data from the API
        $response = Http::get("http://127.0.0.1:8002/api/lecturer/{$id}");

        if ($response->successful()) {
            $lecturer = $response->json()['data'];
            return view('dashboard.lecturers.edit', [
                'title' => 'Ubah Dosen',
                'lecturer' => $lecturer,
            ]);
        } else {
            return redirect()->back()->with('error', 'Gagal mengambil data dosen');
        }
    }


    public function update(UpdateLecturerRequest $request, $id)
    {
        $data = $request->validated();

        // Send PUT request to the API to update the lecturer data
        $response = Http::put("http://127.0.0.1:8002/api/lecturer/{$id}", $data);

        if ($response->successful()) {
            return redirect($request->previous_url ?? route('admin.dashboard.lecturers.index'))->with('success', 'Dosen berhasil diubah');
        } else {
            return redirect()->back()->with('error', 'Gagal mengubah dosen');
        }
    }

    public function destroy($id)
    {
        // Send DELETE request to the API to delete the lecturer
        $response = Http::delete("http://127.0.0.1:8002/api/lecturer/{$id}");

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Dosen berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus dosen');
        }
    }
}
