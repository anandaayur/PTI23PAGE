<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrganizationRequest;
use App\Http\Requests\UpdateOrganizationRequest;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function index()
    {
        return view('dashboard.organizations.index', [
            'title' => 'Daftar Organisasi',
            'organizations' => Organization::withCount('students')
                ->options(request(Organization::$allowedParams))
                ->paginate($this->validateAndGetLimit(request('limit'), 10)),
            'sortables' => Organization::$sortables,
            'allowedParams' => Organization::$allowedParams,
        ]);
    }

    public function store(StoreOrganizationRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $data['logo'] = $this->storeImage($request->file('logo'), 'organizations');
        }

        Organization::create($data);
        return redirect()->back()->with('success', 'Organisasi berhasil ditambahkan');
    }

    public function edit(Organization $organization)
    {
        return view('dashboard.organizations.edit', [
            'title' => 'Ubah Organisasi',
            'organization' => $organization,
        ]);
    }

    public function update(UpdateOrganizationRequest $request, Organization $organization)
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            if ($organization->logo) {
                $this->deleteFile($organization->logo);
            }

            $data['logo'] = $this->storeLogo($request->file('logo'), 'organizations');
        } else {
            $this->deleteFile($organization->logo);
            $data['logo'] = null;
        }

        $organization->update($data);
        return redirect($request->previous_url ?? route('admin.dashboard.organizations.index'))->with('success', 'Organisasi berhasil diubah');
    }

    public function destroy(Organization $organization)
    {
        $this->deleteFile($organization->logo);
        $organization->delete();
        return redirect()->back()->with('success', 'Organisasi berhasil dihapus');
    }
}
