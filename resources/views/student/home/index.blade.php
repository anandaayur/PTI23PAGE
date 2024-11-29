@extends('student.main')

@section('custom-css')
<style>
  .page-body {
    background-image: url("{{ asset('img/filkom.jpg') }}");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    min-height: 100vh;
  }
  
  .content-overlay {
    background-color: rgba(255, 255, 255, 0.9);
    padding: 2rem;
    border-radius: 10px;
  }
</style>
@endsection

@section('content')
  <!-- Page body -->
  <div class="page-body">
    <div class="container-xl">
      <div class="row row-cards" style="height: 80vh;">
        <div class="col-12 text-center" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
          <div class="content-overlay">
            <img src="{{ asset('img/LOGO DASHBOARD.png') }}" alt="Logo Dashboard" style="max-width: 200px; margin-bottom: 2rem;">
            <div style="font-size: 2rem;" class="fw-bold text-dark">
              <div class="">PROFIL PTI 2023</div>
              <div class="">UNIVERSITAS BRAWIJAYA</div>
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
  <script></script>
@endsection
