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
              class="icon icon-tabler icons-tabler-outline icon-tabler-manual-gearbox">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M5 6m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
              <path d="M12 6m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
              <path d="M19 6m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
              <path d="M5 18m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
              <path d="M12 18m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
              <path d="M5 8l0 8" />
              <path d="M12 8l0 8" />
              <path d="M19 8v2a2 2 0 0 1 -2 2h-12" />
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
          <form action="{{ route('admin.dashboard.core-teams.update', $coreTeam->id) }}" class="card" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="previous_url"
              value="{{ getPreviousUrl(route('admin.dashboard.core-teams.index')) }}">
            <div class="card-body">
              <div class="row mb-3">
                <div class="col">
                  <label class="form-label required">Mahasiswa</label>
                  <select class="form-select @error('student_id') is-invalid @enderror" name="student_id">
                    <option value="" disabled selected>Pilih</option>
                    <option value="">Tidak ada</option>
                    @foreach ($students as $student)
                      <option value="{{ $student->id }}" {{ (old('student_id') ?? $coreTeam->student_id) == $student->id ? 'selected' : '' }}>
                        {{ $student->name }}
                      </option>
                    @endforeach
                  </select>
                  @error('student_id')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <div class="col">
                  <label class="form-label required">Divisi</label>
                  <input type="text" class="form-control @error('position') is-invalid @enderror" name="position"
                    placeholder="Masukkan divisi" value="{{ old('position') ?? $coreTeam->position }}" />
                  @error('position')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <div class="col">
                  <label class="form-label required">Urutan</label>
                  <input type="number" class="form-control @error('order') is-invalid @enderror" name="order"
                    placeholder="Masukkan urutan" value="{{ old('order') ?? $coreTeam->order }}" />
                  @error('order')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="card-footer d-flex">
              <a href="{{ getPreviousUrl(route('admin.dashboard.core-teams.index')) }}" class="btn me-auto">Batal</a>
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
