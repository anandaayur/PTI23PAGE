@extends('dashboard.main')

@section('custom-css')
@endsection

@section('content')
  <!-- Page header -->
  <div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center justify-content-center">
        <div class="col-md-6">
          <h2 class="page-title">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="icon icon-tabler icons-tabler-outline icon-tabler-briefcase">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M3 7m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
              <path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" />
              <path d="M12 12l0 .01" />
              <path d="M3 13a20 20 0 0 0 18 0" />
            </svg>
            {{ $title }}
          </h2>
        </div>
      </div>
    </div>
  </div>

  <!-- Page body -->
  <div class="page-body">
    <div class="container-xl">
      <div class="row row-deck row-cards justify-content-center">
        <div class="col-md-6">
          <form action="{{ route('admin.dashboard.working-programs.update', $workingProgram->id) }}" class="card"
            method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="previous_url"
              value="{{ getPreviousUrl(route('admin.dashboard.working-programs.index')) }}">
            <div class="card-body">
              <div class="row mb-3">
                <div class="col">
                  <label class="form-label required">Program Kerja</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    placeholder="Masukkan nama program kerja" value="{{ old('name') ?? $workingProgram->name }}">
                  @error('name')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <div class="col">
                  <label class="form-label">Deskripsi</label>
                  <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                    placeholder="Masukkan deskripsi program kerja">{{ old('description') ?? $workingProgram->description }}</textarea>
                  @error('description')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <div class="col">
                  <label class="form-label required">Divisi</label>
                  <select class="form-select @error('core_team_id') is-invalid @enderror" name="core_team_id">
                    <option value="" disabled selected>Pilih</option>
                    @foreach ($coreTeams as $coreTeam)
                      <option value="{{ $coreTeam->id }}"
                        {{ (old('core_team_id') ?? $workingProgram->core_team_id) == $coreTeam->id ? 'selected' : '' }}>
                        {{ $coreTeam->position }}
                      </option>
                    @endforeach
                  </select>
                  @error('core_team_id')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="card-footer d-flex">
              <a href="{{ getPreviousUrl(route('admin.dashboard.working-programs.index')) }}"
                class="btn me-auto">Batal</a>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('library-js')
@endsection

@section('custom-js')
  <script></script>
@endsection
