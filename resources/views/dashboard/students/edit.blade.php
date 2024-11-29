@extends('dashboard.main')

@section('custom-css')
  <link href="{{ asset('plugins/filepond/filepond.css') }}" rel="stylesheet">
  <link href="{{ asset('plugins/filepond/filepond-plugin-image-preview.css') }}" rel="stylesheet">
@endsection

@section('content')
  <!-- Page header -->
  <div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center justify-content-center">
        <div class="col-md-8">
          <h2 class="page-title">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="icon icon-tabler icons-tabler-outline icon-tabler-users">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
              <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
              <path d="M16 3.13a4 4 0 0 1 0 7.75" />
              <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
            </svg>
            Ubah Mahasiswa
          </h2>
        </div>
      </div>
    </div>
  </div>

  <!-- Page body -->
  <div class="page-body">
    <div class="container-xl">
      <div class="row row-deck row-cards justify-content-center">
        <div class="col-md-8">
          <form action="{{ route('admin.dashboard.students.update', $student->id) }}" class="card"
            method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="previous_url"
              value="{{ getPreviousUrl(route('admin.dashboard.students.index')) }}">
            <div class="card-body">
              <div class="row mb-3">
                <div class="col-md-6">
                  <label class="form-label required">NIM</label>
                  <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim"
                    placeholder="Masukkan NIM mahasiswa" value="{{ old('nim') ?? $student->nim }}" />
                  @error('nim')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="col-md-6">
                  <label class="form-label required">Nama</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    placeholder="Masukkan nama mahasiswa" value="{{ old('name') ?? $student->name }}" />
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
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
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
                      placeholder="Tanggal lahir" id="date-input" value="{{ old('birth_date') ?? $student->birth_date }}"
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
                      <option value="{{ $lecturer->id }}" {{ (old('lecturer_id') ?? $student->lecturer_id) == $lecturer->id ? 'selected' : '' }}>
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
                    placeholder="Masukkan telepon mahasiswa" value="{{ old('phone') ?? $student->phone }}" />
                  @error('phone')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="col-md-6">
                  <label class="form-label">Email</label>
                  <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                    placeholder="Masukkan email mahasiswa" value="{{ old('email') ?? $student->email }}" />
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
                          {{ in_array($organization->id, (old('organization_ids') ?? $student->organizations->pluck('id')->toArray())) ? 'checked' : '' }}>
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
                      placeholder="Tautan linkedin" name="linkedin" value="{{ old('linkedin') ?? $student->linkedin }}">
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
                      placeholder="Tautan instagram" name="instagram" value="{{ old('instagram') ?? $student->instagram }}">
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
                      placeholder="Tautan github" name="github" value={{ old('github') ?? $student->github }}>
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
                      placeholder="Tautan twitter" name="twitter" value={{ old('twitter') ?? $student->twitter }}>
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
            <div class="card-footer d-flex">
              <a href="{{ getPreviousUrl(route('admin.dashboard.students.index')) }}"
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
  <script src="{{ asset('plugins/tabler/dist/libs/litepicker/dist/litepicker.js?1669759017') }}"></script>
  <script src="{{ asset('plugins/filepond/filepond.js') }}"></script>
  <script src="{{ asset('plugins/filepond/filepond-plugin-image-preview.js') }}"></script>
  <script src="{{ asset('plugins/filepond/filepond-plugin-file-validate-type.js') }}"></script>
@endsection

@section('custom-js')
  <script>
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

    @if ($student->photo_url)
      filepond.addFile('{{ $student->photo_url }}');
    @endif

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
