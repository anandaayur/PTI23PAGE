@extends('student.main')

@section('custom-css')
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
    </div>
  </div>

  <!-- Page body -->
  <div class="page-body">
    <div class="container-xl">
      <div class="row row-cards">
        @foreach ($coreTeams as $team)
          <div class="col-md-6 col-lg-4" bis_skin_checked="1">
            <div class="card" bis_skin_checked="1">
              <div class="card-body p-4 text-center" bis_skin_checked="1">
                <span class="avatar avatar-xl mb-3 rounded"
                  style="background-image: url({{ $team->student->photo_url ?? asset('img/default.jpg') }})"></span>
                <h3 class="m-0 mb-1">
                  <a href="{{ route('student.dashboard.students.show', $team->student->id) }}">
                    <span class="font-weight-medium" {{ add_title_tooltip($team->student->name ?? '-', 24) }}>
                      {{ mb_strimwidth($team->student->name, 0, 24, '...') }}
                    </span>
                  </a>
                </h3>
                <div class="text-secondary" bis_skin_checked="1">
                  {{ $team->student->nim ?? '-' }}
                </div>
                <div class="mt-3" bis_skin_checked="1">
                  <span class="badge bg-purple-lt">
                    {{ $team->position ?? '-' }}
                  </span>
                </div>
              </div>
              <div class="d-flex" bis_skin_checked="1">
                <a href="#" class="card-btn" data-bs-toggle="modal" data-bs-target="#modal-working-program" data-programs="{{ $team->workingPrograms ?? '[]' }}">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-briefcase me-2">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M3 7m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                    <path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" />
                    <path d="M12 12l0 .01" />
                    <path d="M3 13a20 20 0 0 0 18 0" />
                  </svg>
                  Lihat Program Kerja
                </a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>

  {{-- Modal Program Kerja --}}
  <div class="modal modal-blur fade" id="modal-working-program" tabindex="-1" bis_skin_checked="1" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" bis_skin_checked="1">
      <div class="modal-content" bis_skin_checked="1">
        <div class="modal-header" bis_skin_checked="1">
          <h5 class="modal-title">Program Kerja</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" bis_skin_checked="1" id="modal-body">
        </div>
        <div class="modal-footer pt-2" bis_skin_checked="1" style="border-top: 1px solid #e9ecef; background-color: #f9fafb;">
          <button type="button" class="btn me-auto" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('library-js')
@endsection

@section('custom-js')
  <script>
    const modalWorkingProgram = document.getElementById('modal-working-program');
    const modalBody = document.getElementById('modal-body');

    modalWorkingProgram.addEventListener('show.bs.modal', function (event) {
      const button = event.relatedTarget;
      const programs = JSON.parse(button.getAttribute('data-programs'));

      modalBody.innerHTML = '';

      programs.forEach((program, index) => {
        modalBody.innerHTML += `
          <div class="mb-3">
            <div class="text-secondary fw-bold">${index + 1}. ${program.name}</div>
            <div class="text-secondary">${program.description ?? '-'}</div>
          </div>
        `;
      });

      if (programs.length === 0) {
        modalBody.innerHTML = `
          <div class="text-center text-secondary">Belum ada program kerja.</div>
        `;
      }
    });
  </script>
@endsection
