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
        <div class="col-md-6">
          <h2 class="page-title">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="icon icon-tabler icons-tabler-outline icon-tabler-users-group">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
              <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" />
              <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
              <path d="M17 10h2a2 2 0 0 1 2 2v1" />
              <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
              <path d="M3 13v-1a2 2 0 0 1 2 -2h2" />
            </svg>
            Ubah Organisasi
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
          <form action="{{ route('admin.dashboard.organizations.update', $organization->id) }}" class="card"
            method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="previous_url"
              value="{{ getPreviousUrl(route('admin.dashboard.organizations.index')) }}">
            <div class="card-body">
              <div class="row mb-3">
                <div class="col">
                  <label class="form-label required">Nama</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    placeholder="Masukkan nama organisasi" value="{{ old('name') ?? $organization->name }}">
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
                    placeholder="Deskripsi organisasi" rows="3">{{ old('description') ?? $organization->description }}</textarea>
                  @error('description')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <div class="col">
                  <label class="form-label">Logo</label>
                  <input name="logo" class="filepond" type="file" accept="image/*">
                  @error('logo')
                    <div class="text-danger fs-5 d-block">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="card-footer d-flex">
              <a href="{{ getPreviousUrl(route('admin.dashboard.organizations.index')) }}" class="btn me-auto">Batal</a>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('library-js')
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

    @if ($organization->logo)
      filepond.addFile('{{ $organization->logo }}');
    @endif
  </script>
@endsection
