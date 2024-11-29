@extends('dashboard.main')

@section('custom-css')
  <style>
    .avatar-custom-size {
      width: 12rem;
      height: 12rem;
    }
  </style>
@endsection

@section('content')
  <!-- Page header -->
  <div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center justify-content-center">
        <div class="col-xl-10">
          <div class="row">
            <div class="col">
              <h2 class="page-title">
                Detail Mahasiswa
              </h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
              <div class="btn-list d-flex">
                <a href="{{ getPreviousUrl(route('admin.dashboard.students.index')) }}"
                  class="btn btn-outline-primary d-none d-sm-inline-block">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M5 12l14 0"></path>
                    <path d="M5 12l6 6"></path>
                    <path d="M5 12l6 -6"></path>
                  </svg>
                  Kembali
                </a>
                <a href="{{ getPreviousUrl(route('admin.dashboard.students.index')) }}"
                  class="btn btn-outline-primary d-sm-none btn-icon" aria-label="Kembali">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M5 12l14 0"></path>
                    <path d="M5 12l6 6"></path>
                    <path d="M5 12l6 -6"></path>
                  </svg>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Page body -->
  <div class="page-body">
    <div class="container-xl">
      <div class="row row-deck row-cards justify-content-center">
        <div class="col-xl-10">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-12 text-center mt-3">
                  <span id="photoPreview" class="avatar avatar-custom-size rounded position-relative mb-5"
                    style="background-image: url({{ $student->photo_url ?? asset('img/default.jpg') }})">
                  </span>
                </div>
                <div class="col-sm-6 col-md-4 col-12">
                  <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <div class="form-control-plaintext">
                      <span {{ add_title_tooltip($student->name ?? '-', 30) }}>
                        {{ mb_strimwidth($student->name ?? '-', 0, 30, '...') }}
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-md-4 col-12">
                  <div class="mb-3">
                    <label class="form-label">NIM</label>
                    <div class="form-control-plaintext">{{ $student->nim }}</div>
                  </div>
                </div>
                <div class="col-sm-6 col-md-4 col-12">
                  <div class="mb-3">
                    <label class="form-label">Dosen PA</label>
                    <div class="form-control-plaintext">
                      <span {{ add_title_tooltip($student->lecturer->name ?? '-', 30) }}>
                        {{ mb_strimwidth($student->lecturer->name ?? '-', 0, 30, '...') }}
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-md-4 col-12">
                  <div class="mb-3">
                    <label class="form-label">Tanggal Lahir</label>
                    <div class="form-control-plaintext">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                        <path d="M16 3l0 4" />
                        <path d="M8 3l0 4" />
                        <path d="M4 11l16 0" />
                        <path d="M8 15h2v2h-2z" />
                      </svg>
                      {{ formatDate($student->birth_date, 'd F Y') }}
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-md-4 col-12">
                  <div class="mb-3">
                    <label class="form-label">Telepon</label>
                    <div class="form-control-plaintext">
                      @if ($student->phone)
                        <a href="{{ getWhatsAppLink($student->phone) }}" target="_blank"
                          class="text-decoration-none text-reset" data-bs-toggle="tooltip" data-bs-placement="bottom"
                          title="Hubungi via WhatsApp">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-whatsapp"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9"></path>
                            <path
                              d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1">
                            </path>
                          </svg>
                          {{ $student->phone }}
                        </a>
                      @else
                        -
                      @endif
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-md-4 col-12">
                  <div class="mb-3">
                    <label class="form-label">Email</label>
                    <div class="form-control-plaintext">
                      @if ($student->email)
                        <a href="mailto:{{ $student->email }}" class="text-decoration-none text-reset" target="_blank">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-mail">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                            <path d="M3 7l9 6l9 -6" />
                          </svg>
                          {{ $student->email }}
                        </a>
                      @else
                        -
                      @endif
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="mb-3">
                    <label class="form-label">Organisasi</label>
                    <ul>
                      @foreach ($student->organizations as $organization)
                        <li>{{ $organization->name }}</li>
                      @endforeach
                      @if ($student->organizations->isEmpty())
                        <span class="text-muted">Tidak mengikuti organisasi</span>
                      @endif
                    </ul>
                  </div>
                </div>
                <div class="col-12">
                  <div class="mb-3">
                    <label class="form-label">Prestasi</label>
                    <ul>
                      @foreach ($student->achievements as $achievement)
                        <li>{{ $achievement->name }} ({{ formatDate($achievement->date, 'F Y') }})</li>
                      @endforeach
                      @if ($student->achievements->isEmpty())
                        <span class="text-muted">Belum memiliki prestasi</span>
                      @endif
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('library-js')
@endsection

@section('custom-js')
@endsection
