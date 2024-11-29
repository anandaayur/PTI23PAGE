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
        <div class="col-12" bis_skin_checked="1">
          <div class="card" bis_skin_checked="1">
            <div class="row row-0" bis_skin_checked="1">
              <div class="col-6 order-md-last" bis_skin_checked="1">
                <!-- Photo -->
                <img src="{{ asset('img/about.jpg') }}"
                  class="w-100 h-100 object-cover card-img-end"
                  alt="">
              </div>
              <div class="col" bis_skin_checked="1">
                <div class="card-body" bis_skin_checked="1">
                  <h3 class="card-title fs-2">Welcome to PTI UB, Tempatnya Calon Guru & Profesional IT Masa Depan!</h3>
                  <p class="text-secondary" style="font-size: 1rem;">
                    Di Pendidikan Teknologi Informasi (PTI) Universitas Brawijaya, kamu nggak cuma belajar teknologi informasi, tapi juga diajari gimana cara jadi pendidik yang kreatif dan inovatif. Kurikulum di sini super update, mulai dari coding, pengembangan aplikasi, hingga teknologi pembelajaran digital. Selain itu, fasilitasnya keren banget—laboratorium IT lengkap, dosen yang asik, dan komunitas mahasiswa yang aktif banget bikin kegiatan seru.
                  </p>
                  <p class="text-secondary" style="font-size: 1rem;">
                    Yang lebih keren lagi, lulusan PTI itu multi-talenta! Bisa jadi guru IT yang bikin murid nggak bosen, pengembang e-learning, atau bahkan profesional IT yang siap bersaing di dunia kerja global. Jadi, kalau kamu mau belajar, berkembang, sekaligus punya peluang karier yang luas, PTI UB adalah tempat yang paling pas buat kamu. Yuk, gabung dan jadi bagian dari perubahan besar di dunia pendidikan dan teknologi! 🚀
                  </p>
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
  <script></script>
@endsection
