@extends('student.main')

@section('custom-css')
  <style>
    .off {
      filter: grayscale(100%);
    }
  </style>
@endsection

@section('content')
  {{-- Page Header --}}
  <div class="page-header d-print-none mt-2">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <h3 class="page-title">
            {{ $title }}
          </h3>
        </div>
      </div>
      <div class="row g-2 align-items-center">
        <div class="col col-sm-8 col-md-6 col-xl-4 mt-3 d-flex">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Cari ..." id="inputSearch" value="{{ request()->q }}">
            <button class="btn btn-icon" type="button" id="btnSearch">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                <path d="M21 21l-6 -6"></path>
              </svg>
            </button>
          </div>
        </div>
        <div class="col-auto mt-3">
          <a href="#" class="btn btn-outline-primary btn-icon me-1" data-bs-toggle="modal"
            data-bs-target="#modal-option">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-filter" width="24"
              height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
              stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <path d="M5.5 5h13a1 1 0 0 1 .5 1.5l-5 5.5l0 7l-4 -3l0 -4l-5 -5.5a1 1 0 0 1 .5 -1.5"></path>
            </svg>
          </a>
          @if (isParamsExist($allowedParams))
            <a href="{{ route('student.dashboard.students.index') }}" class="btn btn-outline-danger btn-icon"
              data-bs-toggle="tooltip" data-bs-original-title="Bersihkan filter pencarian" data-bs-placement="bottom">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-x" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M4 7h16"></path>
                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                <path d="M10 12l4 4m0 -4l-4 4"></path>
              </svg>
            </a>
          @endif
        </div>
      </div>
    </div>
  </div>

  <!-- Page body -->
  <div class="page-body">
    <div class="container-xl">
      <div class="row row-deck row-cards">
        @foreach ($students as $student)
          <div class="col-md-6 col-lg-4" bis_skin_checked="1">
            <div class="card" bis_skin_checked="1">
              <div class="card-body p-4 text-center" bis_skin_checked="1">
                <span class="avatar avatar-xl mb-3 rounded"
                  style="background-image: url({{ $student->photo_url ?? asset('img/default.jpg') }})"></span>
                <h3 class="m-0 mb-1">
                  <a href="{{ route('student.dashboard.students.show', $student->id) }}">
                    <span {{ add_title_tooltip($student->name ?? '-', 25) }}>
                      {{ mb_strimwidth($student->name ?? '-', 0, 25, '...') }}
                    </span>
                    @if ($student->coreTeam)
                      <img src="{{ asset('img/sosmed/verified.png') }}" alt="" height="20"
                        data-bs-toggle="tooltip" data-bs-placement="top"
                        title="Pengurus Inti ({{ $student->coreTeam->position }})">
                    @endif
                  </a>
                </h3>
                <div class="text-secondary">
                  {{ $student->nim ?? '-' }}
                </div>

                <div class="row mt-3">
                  <div class="col-6">
                    <div class="fw-bold">
                      {{ $student->organizations_count ?? 0 }}
                    </div>
                    <div class="text-muted small">Organisasi</div>
                  </div>
                  <div class="col-6">
                    <div class="fw-bold">
                      {{ $student->achievements_count ?? 0 }}
                    </div>
                    <div class="text-muted small">Prestasi</div>
                  </div>
                </div>

                <div class="mt-4">
                  <a href="{{ $student->linkedin }}" class="text-decoration-none" target="_blank"
                    {{ $student->linkedin ?: 'disabled' }}>
                    <img class="{{ $student->linkedin ?: 'off' }}" src="{{ asset('img/sosmed/linkedin.svg') }}"
                      alt="linkedin" height="20">
                  </a>
                  <a href="{{ $student->instagram }}" class="ms-2 text-coration-none" target="_blank"
                    {{ $student->instagram ?: 'disabled' }}>
                    <img class="{{ $student->instagram ?: 'off' }}" src="{{ asset('img/sosmed/instagram.svg') }}"
                      alt="instagram" height="20">
                  </a>
                  <a href="{{ $student->twitter }}" class="ms-2 text-decoration-none" target="_blank"
                    {{ $student->twitter ?: 'disabled' }}>
                    <img class="{{ $student->twitter ?: 'off' }}" src="{{ asset('img/sosmed/twitter.svg') }}"
                      alt="twitter" height="20">
                  </a>
                  <a href="{{ $student->github }}" class="ms-2 text-decoration-none" target="_blank"
                    {{ $student->github ?: 'disabled' }}>
                    <img class="{{ $student->github ?: 'off' }}" src="{{ asset('img/sosmed/github.svg') }}"
                      alt="github" height="20">
                  </a>
                </div>

                <div class="mt-4">
                  <a href="{{ route('student.dashboard.students.show', $student->id) }}"
                    class="btn btn-pill btn-outline-primary">
                    Lihat Profil
                  </a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
        @if ($students->count() == 0)
          <div class="empty" style="margin-top: 100px;">
            <div class="empty-img"><img src="{{ asset('img\error\undraw_quitting_time_dm8t.svg') }}" height="128">
            </div>
            <p class="empty-title">Mahasiswa tidak ditemukan</p>
            <p class="empty-subtitle text-muted">
              Coba sesuaikan pencarian atau filter anda untuk menemukan apa yang anda cari.
            </p>
            <div class="empty-action">
              <a href="{{ route('student.dashboard.students.index') }}" class="btn btn-outline-danger">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24"
                  height="24" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none"
                  stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path
                    d="M4 7l16 0m-10 4l0 6m4 -6l0 6m-9 -10l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12m-10 0v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3">
                  </path>
                </svg>
                Bersihkan filter pencarian
              </a>
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>

  {{-- Modal option --}}
  <div class="modal modal-blur fade" id="modal-option" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Filter Pencarian</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="GET" id="formOption">
          <input type="hidden" name="q" id="q">
          <div class="modal-body">
            <div class="row mb-3">
              <div class="col-12">
                <div class="form-label">Tampilkan</div>
                <div class="form-selectgroup">
                  <label class="form-selectgroup-item">
                    <input type="radio" name="limit" value="20" class="form-selectgroup-input"
                      {{ request()->limit == '20' ? 'checked' : '' }}>
                    <span class="form-selectgroup-label">
                      20
                    </span>
                  </label>
                  <label class="form-selectgroup-item">
                    <input type="radio" name="limit" value="50" class="form-selectgroup-input"
                      {{ request()->limit == '50' ? 'checked' : '' }}>
                    <span class="form-selectgroup-label">
                      50
                    </span>
                  </label>
                  <label class="form-selectgroup-item">
                    <input type="radio" name="limit" value="100" class="form-selectgroup-input"
                      {{ request()->limit == '100' ? 'checked' : '' }}>
                    <span class="form-selectgroup-label">
                      100
                    </span>
                  </label>
                  <label class="form-selectgroup-item">
                    <input type="radio" name="limit" value="200" class="form-selectgroup-input"
                      {{ request()->limit == '200' ? 'checked' : '' }}>
                    <span class="form-selectgroup-label">
                      200
                    </span>
                  </label>
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-12">
                <div class="form-label">Urutkan Berdasarkan</div>
                <select class="form-select" name="sortby">
                  <option value="" disabled selected>Pilih</option>
                  @foreach ($sortables as $key => $value)
                    <option value="{{ $key }}" {{ request()->sortby == $key ? 'selected' : '' }}>
                      {{ $value }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-12">
                <div class="form-label">Urutan</div>
                <div class="form-selectgroup">
                  <label class="form-selectgroup-item">
                    <input type="radio" name="order" value="asc" class="form-selectgroup-input"
                      {{ request()->order == 'asc' ? 'checked' : '' }}>
                    <span class="form-selectgroup-label">
                      <svg xmlns="http://www.w3.org/2000/svg"
                        class="icon icon-tabler icon-tabler-sort-ascending-letters me-1" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M15 10v-5c0 -1.38 .62 -2 2 -2s2 .62 2 2v5m0 -3h-4"></path>
                        <path d="M19 21h-4l4 -7h-4"></path>
                        <path d="M4 15l3 3l3 -3"></path>
                        <path d="M7 6v12"></path>
                      </svg>
                      Ascending
                    </span>
                  </label>
                  <label class="form-selectgroup-item">
                    <input type="radio" name="order" value="desc" class="form-selectgroup-input"
                      {{ request()->order == 'desc' ? 'checked' : '' }}>
                    <span class="form-selectgroup-label">
                      <svg xmlns="http://www.w3.org/2000/svg"
                        class="icon icon-tabler icon-tabler-sort-descending-letters me-1" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M15 21v-5c0 -1.38 .62 -2 2 -2s2 .62 2 2v5m0 -3h-4"></path>
                        <path d="M19 10h-4l4 -7h-4"></path>
                        <path d="M4 15l3 3l3 -3"></path>
                        <path d="M7 6v12"></path>
                      </svg>
                      Descending
                    </span>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal">Tutup</button>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="btnFormOption">Cari</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('library-js')
@endsection

@section('custom-js')
  <script>
    const formOption = document.getElementById('formOption');
    const btnFormOption = document.getElementById('btnFormOption');

    const inputSearch = document.getElementById('inputSearch');
    const btnSearch = document.getElementById('btnSearch');
    const q = document.getElementById('q');

    btnFormOption.addEventListener('click', submitFormOption);
    btnSearch.addEventListener('click', submitFormOption);
    inputSearch.addEventListener('keyup', function(event) {
      if (event.keyCode === 13) {
        event.preventDefault();
        btnSearch.click();
      }
    });

    function submitFormOption() {
      q.value = inputSearch.value;
      formOption.submit();
    }
  </script>
@endsection
