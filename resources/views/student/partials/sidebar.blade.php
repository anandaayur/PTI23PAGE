<aside class="navbar navbar-vertical navbar-expand-lg navbar-light">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
      aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <h1 class="navbar-brand navbar-brand-autodark mt-lg-2">
      <a href="{{ route('admin.dashboard.home.index') }}">
        PTI23 Page App
      </a>
    </h1>
    <div class="navbar-nav flex-row d-lg-none">
      <div class="nav-item dropdown">
        <a class="nav-link d-flex lh-1 text-reset p-0 cursor-pointer" data-bs-toggle="dropdown"
          aria-label="Open user menu">
          <span class="avatar avatar-sm"
            style="background-image: url({{ auth()->user()->avatar_url ?? asset('img/default.jpg') }})"></span>
        </a>
        <div class="text-muted dropdown-menu dropdown-menu-end dropdown-menu-arrow">
          <a href="{{ route('dashboard.profile.index') }}" class="dropdown-item">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user me-1" width="24"
              height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
              stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
              <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
            </svg>
            Profile Saya
          </a>
          <a href="{{ route('dashboard.auth.change-password') }}" class="dropdown-item">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock me-1" width="24"
              height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
              stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <path d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z"></path>
              <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0"></path>
              <path d="M8 11v-4a4 4 0 1 1 8 0v4"></path>
            </svg>
            Ubah Kata Sandi
          </a>
          <form action="{{ route('dashboard.auth.logout') }}" method="POST">
            @csrf
            <button type="submit" class="dropdown-item">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout me-1" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2">
                </path>
                <path d="M7 12h14l-3 -3m0 6l3 -3"></path>
              </svg>
              Keluar
            </button>
          </form>
        </div>
      </div>
    </div>
    <div class="collapse navbar-collapse" id="sidebar-menu">
      <ul class="navbar-nav pt-lg-3">
        <li class="nav-item {{ Request::is('student/dashboard/home*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('student.dashboard.home.index') }}">
            <span class="nav-link-icon d-lg-inline-block">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
              </svg>
            </span>
            <span class="nav-link-title">
              Beranda
            </span>
          </a>
        </li>
        <li class="nav-item {{ Request::is('student/dashboard/about*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('student.dashboard.about.index') }}">
            <span class="nav-link-icon d-lg-inline-block">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-info-circle">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                <path d="M12 9h.01" />
                <path d="M11 12h1v4h1" />
              </svg>
            </span>
            <span class="nav-link-title">
              Tentang PTI
            </span>
          </a>
        </li>
        <li class="nav-item {{ Request::is('student/dashboard/students*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('student.dashboard.students.index') }}">
            <span class="nav-link-icon d-lg-inline-block">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
              </svg>
            </span>
            <span class="nav-link-title">
              Profil Mahasiswa
            </span>
          </a>
        </li>
        <li class="nav-item {{ Request::is('student/dashboard/core-teams*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('student.dashboard.core-teams.index') }}">
            <span class="nav-link-icon d-lg-inline-block">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-manual-gearbox">
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
            </span>
            <span class="nav-link-title">
              Pengurus Inti
            </span>
          </a>
        </li>
        <li class="nav-item {{ Request::is('student/dashboard/contact*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('student.dashboard.contact.index') }}">
            <span class="nav-link-icon d-lg-inline-block">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-address-book">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M20 6v12a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2z" />
                <path d="M10 16h6" />
                <path d="M13 11m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                <path d="M4 8h3" />
                <path d="M4 12h3" />
                <path d="M4 16h3" />
              </svg>
            </span>
            <span class="nav-link-title">
              Kontak
            </span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</aside>
