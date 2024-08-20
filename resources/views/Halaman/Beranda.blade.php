<!DOCTYPE html>
<html lang="en">

<head>
    @include('Template.head')
</head>

<body>

  <!-- ======= Navbar ======= -->
    @include('Template.navbar')  

  <!-- ======= Sidebar ======= -->
    @include('Template.sidebar')
  

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          {{ Breadcrumbs::render('beranda') }}
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Selamat Datang</h5>
                  <p>Kamu sudah masuk {{ Auth::user()->name }}</p>
                </div>
              </div>
            </div>
        </div>
        
        @if (Auth::guard('user')->check())
        <div class="row">
            <!-- Card for Mahasiswa -->
            <div class="col-xxl-4 col-md-4">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Jumlah <span>| Mahasiswa</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $jumlahMahasiswa }}</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Card for Dosen -->
            <div class="col-xxl-4 col-md-4">
              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">Jumlah <span>| Dosen</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $jumlahDosen }}</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Card for Mata Kuliah -->
            <div class="col-xxl-4 col-md-4">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Jumlah <span>| Mata Kuliah</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-book-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $jumlahMataKuliah }}</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endif
        </div>
    </section>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    @include('Template.footer')
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    @include('Template.scripts')

</body>

</html>
