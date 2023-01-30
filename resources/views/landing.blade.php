<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Berkah Medical Center | Tulus, Ikhlas, Antusias</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ url('/assets') }}/css/my-main.css">
  <style>
    body{
      margin-top: 50px;
    }
  </style>
</head>
<body id="home">
  {{-- navbar --}}
  <nav class="navbar fixed-top navbar-expand-lg bg-white navbar-light shadow my-navbar">
    <div class="container">
      <a class="navbar-brand" href="/">
        <img src="{{ url('assets') }}/images/logo-solid.png" height="30" alt="Logo Klinik Berkah Medical Center">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="#home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#profil">Profil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#layanan">Layanan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#dokter">Dokter</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#galeri">Galeri</a>
          </li>
          <li class="nav-item">
            <a class="nav-link py-1 mt-1 btn my-btn-success" href="/login">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  {{-- end navbar --}}

  {{-- hero --}}
  <section class="hero">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-8 col-md-7 d-block d-md-none pt-5">
          <img src="{{ url('assets') }}/images/logo-transparent.png" alt="Banner Image" width="100%" class="hero-logo">
        </div>
        <div class="col-12 col-lg-7 col-md-7">
          <h1>Klinik Pratama<br>Berkah Medical Center</h1>
          <p class="hero-text h5 mb-3">Tulus, Ikhlas, Antusias</p>
          <a href="#" class="btn my-btn-success">Berobat Sekarang</a>
          <a href="#" class="btn my-btn-dark ms-2">Kontak Kami</a>
        </div>
        <div class="col-lg-5 col-md-5 d-none d-md-block pt-5">
          <img src="{{ url('assets') }}/images/logo-transparent.png" alt="Banner Image" width="100%" class="hero-logo">
        </div>
      </div>
    </div>
  </section>
  {{-- end hero --}}

  {{-- IGD service --}}
  <section class="igd">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-11 col-md-10 col-lg-8 my-bg-success rounded text-center py-2">
          <h2 class="text-white h1 m-0">IGD</h2>
          <p class="m-0 h5">Instalasi Gawat Darurat</p>
        </div>
      </div>
    </div>
  </section>
  {{-- end IGD service --}}

  {{-- profile --}}
  <section class="profil py-5" id="profil">
    <div class="container">
      <p class="section-badge">Profil</p>
      <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-7">
          <h2 class="section-title">Profil Singkat Klinik Pratama<br>Berkah Medical Center</h2>
          <p>Klinik Pratama Berkah medical center merupakan klinik umum yang di dirikan oleh dr. Muchsyim pada tanggal 20 februari 2021. Klinik Pratama Berkah medical center terletak sangat strategis yaitu di Jln. R.A. Basyid Kel. Fajar Baru Kec.Jati Agung Kab. Lampung Selatan. Tujuan berdirinya Klinik Pratama Berkah Medical Center  adalah demi meningkatkan mutu pelayanan kesehatan bagi masyarakat umum sekitarnya dan ASKES Komersil lainnya. Dalam memberikan pelayanan terhadap pasien, Klinik Pratama Berkah Medical Center  beroperasi hari Senin – Sabtu dari jam 08.00 – 20.00, dengan tim dokter yang selalu siap untuk melayani pasien, dan dibantu oleh perawat dan tenaga administrasi. </p>
        </div>
        <div class="col-md-4 col-lg-5 d-none d-md-block">
          <img src="{{ url('assets') }}/images/profile.jpg" alt="Foto Profil Berkah Medical Center" class="w-100">
        </div>
      </div>
    </div>
  </section>
  {{-- end profile --}}

  {{-- layanan --}}
  <section class="layanan py-5 my-bg-light text-center" id="layanan">
    <div class="container">
      <p class="section-badge">Layanan</p>
      <h2 class="section-title">Layanan Kami</h2>
      <p>berikut ini adalah beberapa layanan yang kami sediakan untuk pengobatan anda</p>
      <div class="row justify-content-center g-3">
        @foreach( $universalServices as $service )
        @if( $loop->iteration <= 3 )
        <div class="col-12 col-md-4">
          <div class="card border-0 shadow">
            <div class="card-body">
              <img src="{{ url('storage') . '/' . $service->icon }}" alt="Icon {{ $service->name }}" class="icon mb-3">
              <h3 class="h4">{{ $service->name }}</h3>
              <p>{{ $service->description }}</p>
            </div>
          </div>
        </div>
        @else
        <div class="col-12 col-md-6">
          <div class="card border-0 shadow">
            <div class="card-body">
              <img src="{{ url('storage') . '/' . $service->icon }}" alt="Icon {{ $service->name }}" class="icon mb-3">
              <h3 class="h4">{{ $service->name }}</h3>
              <p>{{ $service->description }}</p>
            </div>
          </div>
        </div>
        @endif
        @endforeach
      </div>
      <h2 class="section-title mt-5">Pemeriksaan Laboratorium</h2>
      <p>berikut ini adalah beberapa laboratorium yang kami sediakan untuk pemeriksaan anda</p>
      <div class="row justify-content-center g-3">
        @foreach( $labServices as $service )
        <div class="col-12 col-md-4">
          <div class="card border-0 shadow">
            <div class="card-body">
              <img src="{{ url('storage') . '/' . $service->icon }}" alt="Icon {{ $service->name }}" class="icon mb-3">
              <h3 class="h4">{{ $service->name }}</h3>
              <p>{{ $service->description }}</p>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>
  {{-- end layanan --}}

  {{-- dokter --}}
  <section class="dokter py-5 text-center" id="dokter">
    <div class="container">
      <p class="section-badge">Dokter</p>
      <h2 class="section-title">Dokter Expert Kami</h2>
      <p>berikut ini adalah beberapa dokter spesialis yang siap melayani pengobatan anda</p>
      <div class="row justify-content-center g-3 gx-5">
        @foreach( $doctors as $doctor )
        <div class="col-12 col-md-4">
          <div class="card border-0 shadow">
            <img src="{{ url('storage') . '/' . $doctor->photo }}" class="card-img-top rounded-0" alt="Foto {{ $doctor->name }}">
            <div class="card-body my-bg-dark py-2">
              <h3 class="h5 m-0">{{ $doctor->name }}</h3>
              <p class="doctor-description m-0">{{ $doctor->specialist }}</p>
              <p class="m-0">{{ $doctor->practice_time }}</p>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>
  {{-- end dokter --}}

  {{-- galeri --}}
  <section class="galeri my-bg-light py-5" id="galeri">
    <div class="container">
      <p class="section-badge text-center">Galeri</p>
      <h2 class="section-title text-center">Galeri Kegiatan Kami</h2>
      <p class="text-center">berikut ini adalah beberapa dokumentasi yang kami lakukan dalam mengobati pasien</p>
      <div class="row justify-content-center g-3">
        @foreach( $events as $event )
        <div class="col-12 col-md-4">
          <div class="card border-0 rounded-0 shadow">
            <img src="{{ url('storage') . '/' . $event->photo }}" class="card-img-top rounded-0" alt="Foto {{ $event->name }}">
            <div class="card-body">
              <h3 class="h5 mb-1">{{ $event->name }}</h3>
              <p class="m-0">{{ $event->description }}</p>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>
  {{-- end galeri --}}

  {{-- footer --}}
  <footer class="my-bg-dark">
    <div class="container py-5">
      <div class="row">
        <div class="col-12 col-md-6">
          <img src="{{ url('assets') }}/images/logo-white.png" alt="Logo putih Berkah Medical Center" class="mb-3" height="40">
          <h2 class="h3">Klinik Pratama<br>Berkah Medical Center</h2>
          <p class="m-0">Jl. R.A Basyid, Kelurahan Fajar Baru, Kec Jati Agung, Kab Lampung Selatan</p>
        </div>
        <div class="col-12 col-md-6">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4701.758207266918!2d105.26340611521873!3d-5.349220455058487!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40c56f658631df%3A0xbf64e239d262dbc9!2sKlinik%20Berkah%20Medical%20Center!5e1!3m2!1sen!2sid!4v1673844415401!5m2!1sen!2sid" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="border-0 rounded w-100"></iframe>
        </div>
      </div>
    </div>
    <div class="my-bg-black py-3">
      <div class="container">
        <p class="m-0">Copyright &copy; 2022. Klinik Pratama Berkah Medical Center</p>
      </div>
    </div>
  </footer>
  {{-- end footer --}}




  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>