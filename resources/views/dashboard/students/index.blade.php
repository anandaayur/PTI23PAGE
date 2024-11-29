@extends('dashboard.main')

@section('custom-css')
  <link href="{{ asset('plugins/filepond/filepond.css') }}" rel="stylesheet">
  <link href="{{ asset('plugins/filepond/filepond-plugin-image-preview.css') }}" rel="stylesheet">
  <style>
    .btn-action-delete:hover {
      background-color: #f44336;
      color: white;
      transition: 0.3s;
    }

    .user-photo:hover {
      opacity: 0.8;
      transition: 0.3s;
      cursor: pointer;
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
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="icon icon-tabler icons-tabler-outline icon-tabler-users">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
              <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
              <path d="M16 3.13a4 4 0 0 1 0 7.75" />
              <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
            </svg>
            {{ $title }}
          </h3>
          <div class="text-muted mt-1">
            {{ $students->firstItem() ?? '0' }}-{{ $students->lastItem() ?? '0' }} dari
            {{ $students->total() }}
            mahasiswa
          </div>
        </div>
        <div class="col-auto ms-auto d-print-none">
          <div class="btn-list d-flex">
            <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
              data-bs-target="#modalAdd" id="btnAdd">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M12 5l0 14"></path>
                <path d="M5 12l14 0"></path>
              </svg>
              Tambah Mahasiswa
            </a>
            <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modalAdd"
              aria-label="Tambah mahasiswa">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M12 5l0 14"></path>
                <path d="M5 12l14 0"></path>
              </svg>
            </a>
          </div>
        </div>
      </div>
      <div class="row g-2 align-items-center">
        <div class="col col-sm-8 col-md-6 col-xl-4 mt-3 d-flex">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Cari ..." id="inputSearch"
              value="{{ request()->q }}">
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
            <a href="{{ route('admin.dashboard.students.index') }}" class="btn btn-outline-danger btn-icon"
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
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="table-responsive">
              <table class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Tanggal Lahir</th>
                    <th>Dosen PA</th>
                    <th>Telepon</th>
                    <th>Email</th>
                    <th class="text-center">Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($students as $student)
                    <tr>
                      <td class="text-muted">{{ $loop->iteration + $students->firstItem() - 1 }}</td>
                      <td class="text-muted">{{ $student->nim }}</td>
                      <td>
                        <div class="d-flex py-1 align-items-center">
                          <a class="avatar me-2 img-preview cursor-pointer" data-fslightbox="user-{{ $student->id }}"
                            href="{{ $student->photo_url ?? asset('img/default.jpg') }}"
                            style="background-image: url({{ $student->photo_url ?? asset('img/default.jpg') }})">
                          </a>
                          <div class="flex-fill">
                            <div>
                              <span class="font-weight-medium" {{ add_title_tooltip($student->name ?? '-', 24) }}>
                                {{ mb_strimwidth($student->name, 0, 24, '...') }}
                              </span>
                            </div>
                            <div>
                              <span class="text-muted" {{ add_title_tooltip($student->email ?? '-', 24) }}>
                                {{ mb_strimwidth($student->email, 0, 24, '...') }}
                              </span>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td class="text-muted">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                          fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round"
                          class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                          <path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                          <path d="M16 3l0 4" />
                          <path d="M8 3l0 4" />
                          <path d="M4 11l16 0" />
                          <path d="M8 15h2v2h-2z" />
                        </svg>
                        {{ formatDate($student->birth_date, 'd F Y') }}
                      </td>
                      <td class="text-muted">
                        <span {{ add_title_tooltip($student->lecturer->name ?? '-', 30) }}>
                          {{ mb_strimwidth($student->lecturer->name ?? '-', 0, 30, '...') }}
                        </span>
                      </td>
                      <td class="text-muted">
                        @if ($student->phone)
                          <a href="{{ getWhatsAppLink($student->phone) }}" target="_blank"
                            class="text-decoration-none text-reset" data-bs-toggle="tooltip" data-bs-placement="bottom"
                            title="Hubungi via WhatsApp">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-whatsapp"
                              width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                              stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
                      </td>
                      <td class="text-muted">
                        @if ($student->email)
                          <a href="mailto:{{ $student->email }}" class="text-decoration-none text-reset"
                            target="_blank">
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
                      </td>
                      <td>
                        <div class="d-flex justify-content-center">
                          <button class="btn btn-icon btn-pill bg-muted-lt ms-1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-dots-vertical"
                              width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                              stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                              <circle cx="12" cy="12" r="1">
                              </circle>
                              <circle cx="12" cy="19" r="1">
                              </circle>
                              <circle cx="12" cy="5" r="1">
                              </circle>
                            </svg>
                          </button>
                          <div class="text-muted dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('admin.dashboard.students.show', $student->id) }}">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-file-text me-2">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                <path d="M9 9l1 0" />
                                <path d="M9 13l6 0" />
                                <path d="M9 17l6 0" />
                              </svg>
                              Detail
                            </a>
                            <a class="dropdown-item" href="{{ route('admin.dashboard.students.edit', $student->id) }}">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit me-2"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                </path>
                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1">
                                </path>
                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                </path>
                                <path d="M16 5l3 3"></path>
                              </svg>
                              Ubah
                            </a>
                            <button class="dropdown-item btn-action-delete"
                              data-action="{{ route('admin.dashboard.students.destroy', $student->id) }}"
                              data-bs-toggle="modal" data-bs-target="#modalDelete">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler me-2" width="24"
                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <line x1="4" y1="7" x2="20" y2="7" />
                                <line x1="10" y1="11" x2="10" y2="17" />
                                <line x1="14" y1="11" x2="14" y2="17" />
                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                              </svg>
                              Hapus
                            </button>
                          </div>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                  @if ($students->count() == 0)
                    <tr class="text-center">
                      <td colspan="99">
                        <div class="empty bg-transparent" style="height: 500px;">
                          <div class="empty-img"><img src="{{ asset('img\error\undraw_quitting_time_dm8t.svg') }}"
                              height="128">
                          </div>
                          <p class="empty-title">Mahasiswa tidak ditemukan</p>
                          <p class="empty-subtitle text-muted">
                            Coba sesuaikan pencarian atau filter untuk menemukan apa yang anda
                            cari.
                          </p>
                          <div class="empty-action">
                            <a href="{{ route('admin.dashboard.students.index') }}" class="btn btn-outline-danger">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="1"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                </path>
                                <path
                                  d="M4 7l16 0m-10 4l0 6m4 -6l0 6m-9 -10l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12m-10 0v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3">
                                </path>
                              </svg>
                              Bersihkan filter pencarian
                            </a>
                          </div>
                        </div>
                      </td>
                    </tr>
                  @endif
                </tbody>
              </table>
            </div>
            @if ($students->perPage() < $students->total())
              <div class="mt-3 ms-3">
                {{ $students->withQueryString()->onEachSide(1)->links('pagination.custom') }}
              </div>
            @endif
          </div>
        </div>
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

  {{-- Modal delete --}}
  <div class="modal modal-blur fade" id="modalDelete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
      <div class="modal-content">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-status bg-danger"></div>
        <div class="modal-body text-center py-4">
          <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
          <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24"
            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
            stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M12 9v2m0 4v.01" />
            <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
          </svg>
          <h3>Apakah anda yakin?</h3>
          <div class="text-muted">Data yang dihapus tidak dapat dikembalikan.</div>
        </div>
        <div class="modal-footer">
          <div class="w-100">
            <div class="row">
              <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                  Batal
                </a></div>
              <div class="col">
                <form method="post" id="formDelete">
                  @csrf
                  @method('delete')
                  <button type="submit" class="btn btn-danger w-100" id="btnDelete">
                    Hapus
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Modal add --}}
  <form action="{{ route('admin.dashboard.students.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal modal-blur fade" id="modalAdd" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Mahasiwa</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row mb-3">
              <div class="col-md-6">
                <label class="form-label required">NIM</label>
                <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim"
                  placeholder="Masukkan NIM mahasiswa" value="{{ old('nim') }}" />
                @error('nim')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="col-md-6">
                <label class="form-label required">Nama</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                  placeholder="Masukkan nama mahasiswa" value="{{ old('name') }}" />
                @error('name')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <div class="form-label required">Tanggal Lahir</div>
                <div class="input-icon">
                  <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                      viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                      stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                      <rect x="4" y="5" width="16" height="16" rx="2" />
                      <line x1="16" y1="3" x2="16" y2="7" />
                      <line x1="8" y1="3" x2="8" y2="7" />
                      <line x1="4" y1="11" x2="20" y2="11" />
                      <line x1="11" y1="15" x2="12" y2="15" />
                      <line x1="12" y1="15" x2="12" y2="18" />
                    </svg>
                  </span>
                  <input class="form-control @error('birth_date') is-invalid @enderror" name="birth_date"
                    placeholder="Tanggal lahir" id="date-input" value="{{ old('birth_date') ?? '2005-01-01' }}"
                    autocomplete="off">
                </div>
                @error('birth_date')
                  <div class="text-danger fs-5 mt-1">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="col-md-6">
                <label class="form-label required">Dosen PA</label>
                <select type="text" class="form-select @error('lecturer_id') is-invalid @enderror"
                  id="select-lecturer" name="lecturer_id">
                  <option value="" disabled selected>Pilih dosen PA</option>
                  @foreach ($lecturers as $lecturer)
                    <option value="{{ $lecturer->id }}" {{ old('lecturer_id') == $lecturer->id ? 'selected' : '' }}>
                      {{ $lecturer->name }}
                    </option>
                  @endforeach
                </select>
                @error('lecturer_id')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label class="form-label">Telepon</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                  placeholder="Masukkan telepon mahasiswa" value="{{ old('phone') }}" />
                @error('phone')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                  placeholder="Masukkan email mahasiswa" value="{{ old('email') }}" />
                @error('email')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            <div class="row mb-3">
              <div class="col">
                <label class="form-label">Organisasi</label>
                <div>
                  @foreach ($organizations as $organization)
                    <label class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" name="organization_ids[]"
                        value="{{ $organization->id }}"
                        {{ in_array($organization->id, old('organization_ids', [])) ? 'checked' : '' }}>
                      <span class="form-check-label">{{ $organization->name }}</span>
                    </label>
                  @endforeach
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col=12">
                <label class="form-label">Sosial Media</label>
              </div>
              <div class="col-md-6 mb-2">
                <div class="input-icon">
                  <span class="input-icon-addon">
                    <img src="{{ asset('img/sosmed/linkedin.svg') }}" alt="Linkedin">
                  </span>
                  <input type="text" class="form-control @error('linkedin') is-invalid @enderror"
                    placeholder="Tautan linkedin" name="linkedin" value="{{ old('linkedin') }}">
                </div>
                @error('linkedin')
                  <span class="text-danger fs-5">
                    {{ $message }}
                  </span>
                @enderror
              </div>
              <div class="col-md-6 mb-2">
                <div class="input-icon">
                  <span class="input-icon-addon">
                    <img src="{{ asset('img/sosmed/instagram.svg') }}" alt="Instagram">
                  </span>
                  <input type="text" class="form-control @error('instagram') is-invalid @enderror"
                    placeholder="Tautan instagram" name="instagram" value="{{ old('instagram') }}">
                </div>
                @error('instagram')
                  <span class="text-danger fs-5">
                    {{ $message }}
                  </span>
                @enderror
              </div>
              <div class="col-md-6 mb-2">
                <div class="input-icon">
                  <span class="input-icon-addon">
                    <img src="{{ asset('img/sosmed/github.svg') }}" alt="Github" style="width: 20px;">
                  </span>
                  <input type="text" class="form-control @error('github') is-invalid @enderror"
                    placeholder="Tautan github" name="github" value={{ old('github') }}>
                </div>
                @error('github')
                  <span class="text-danger fs-5">
                    {{ $message }}
                  </span>
                @enderror
              </div>
              <div class="col-md-6 mb-2">
                <div class="input-icon">
                  <span class="input-icon-addon">
                    <img src="{{ asset('img/sosmed/twitter.svg') }}" alt="Twitter" style="width: 20px;">
                  </span>
                  <input type="text" class="form-control @error('twitter') is-invalid @enderror"
                    placeholder="Tautan twitter" name="twitter" value={{ old('twitter') }}>
                </div>
                @error('twitter')
                  <span class="text-danger fs-5">
                    {{ $message }}
                  </span>
                @enderror
              </div>
            </div>
            <div class="row mb-3">
              <div class="col">
                <label class="form-label">Foto</label>
                <input name="photo" class="filepond" type="file" accept="image/*">
                @error('photo')
                  <div class="text-danger fs-5 d-block">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>
          <div class="modal-footer pt-2" style="border-top: 1px solid #e9ecef;">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M12 5l0 14"></path>
                <path d="M5 12l14 0"></path>
              </svg>
              Simpan
            </button>
          </div>
        </div>
      </div>
    </div>
  </form>

  {{-- Modal photo --}}
  <div class="modal modal-blur fade" id="modalPhoto" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body text-center">
        </div>
      </div>
    </div>
  </div>
@endsection

@section('library-js')
  <script src="{{ asset('plugins/tabler/dist/libs/fslightbox/index.js') }}" defer></script>
  <script src="{{ asset('plugins/tabler/dist/libs/litepicker/dist/litepicker.js?1669759017') }}"></script>
  <script src="{{ asset('plugins/filepond/filepond.js') }}"></script>
  <script src="{{ asset('plugins/filepond/filepond-plugin-image-preview.js') }}"></script>
  <script src="{{ asset('plugins/filepond/filepond-plugin-file-validate-type.js') }}"></script>
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

    const modalDelete = document.getElementById('modalDelete');

    modalDelete.addEventListener('show.bs.modal', function(event) {
      formDelete.action = event.relatedTarget.dataset.action;
    });

    $(document).ready(function() {
      @if ($errors->any())
        $('#modalAdd').modal('show');
      @endif
    });

    function showModalPhoto(imgUrl, name) {
      $('#modalPhoto .modal-body').html(
        `<img src="${imgUrl}" alt="Logo organization" class="img-fluid rounded" style="min-height: 300px">`);
      $('#modalPhoto').modal('show');
    }

    FilePond.registerPlugin(
      FilePondPluginFileValidateType,
      FilePondPluginImagePreview,
    );

    const filepond = FilePond.create(document.querySelector('.filepond'), {
      allowFileTypeValidation: true,
      acceptedFileTypes: ['image/*'],
      labelFileTypeNotAllowed: 'File type not allowed',
      storeAsFile: true,
    });

    document.addEventListener("DOMContentLoaded", function() {
      var el;
      window.Litepicker && (new Litepicker({
        element: document.getElementById('date-input'),
        buttonText: {
          previousMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>`,
          nextMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>`,
        },
      }));
    });
  </script>
@endsection
