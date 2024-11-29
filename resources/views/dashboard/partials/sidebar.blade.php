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
        <li class="nav-item {{ Request::is('admin/dashboard/home*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('admin.dashboard.home.index') }}">
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
        <li class="nav-item {{ Request::is('admin/dashboard/students*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('admin.dashboard.students.index') }}">
            <span class="nav-link-icon d-lg-inline-block">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
              </svg>
            </span>
            <span class="nav-link-title">
              Mahasiswa
            </span>
          </a>
        </li>
        <li class="nav-item {{ Request::is('admin/dashboard/achievements*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('admin.dashboard.achievements.index') }}">
            <span class="nav-link-icon d-lg-inline-block">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trophy">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M8 21l8 0" />
                <path d="M12 17l0 4" />
                <path d="M7 4l10 0" />
                <path d="M17 4v8a5 5 0 0 1 -10 0v-8" />
                <path d="M5 9m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                <path d="M19 9m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
              </svg>
            </span>
            <span class="nav-link-title">
              Prestasi
            </span>
          </a>
        </li>
        <li class="nav-item {{ Request::is('admin/dashboard/organizations*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('admin.dashboard.organizations.index') }}">
            <span class="nav-link-icon d-lg-inline-block">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users-group">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" />
                <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                <path d="M17 10h2a2 2 0 0 1 2 2v1" />
                <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                <path d="M3 13v-1a2 2 0 0 1 2 -2h2" />
              </svg>
            </span>
            <span class="nav-link-title">
              Organisasi
            </span>
          </a>
        </li>
        <li class="nav-item {{ Request::is('admin/dashboard/lecturers*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('admin.dashboard.lecturers.index') }}">
            <span class="nav-link-icon d-lg-inline-block">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-school">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M22 9l-10 -4l-10 4l10 4l10 -4v6" />
                <path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4" />
              </svg>
            </span>
            <span class="nav-link-title">
              Dosen
            </span>
          </a>
        </li>
        <li class="nav-item {{ Request::is('admin/dashboard/core-teams*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('admin.dashboard.core-teams.index') }}">
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
        <li class="nav-item {{ Request::is('admin/dashboard/working-programs*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('admin.dashboard.working-programs.index') }}">
            <span class="nav-link-icon d-lg-inline-block">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-briefcase">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M3 7m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                <path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" />
                <path d="M12 12l0 .01" />
                <path d="M3 13a20 20 0 0 0 18 0" />
              </svg>
            </span>
            <span class="nav-link-title">
              Program Kerja
            </span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</aside>
