
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>SIMKES</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{ asset('img/Logo_Polimdo.png') }}" />
        <!-- Bootstrap Icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <!-- SimpleLightbox plugin CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('NiceAdmin/assets/css/app.css') }}" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#page-top">SIMKES</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0 align-items-center">
                        <li class="nav-item"><a class="nav-link" href="#about">Beranda</a></li>
                        <li class="nav-item"><a class="nav-link" href="#services">Tentang</a></li>
                        <li class="nav-item"><a class="nav-link" href="#portfolio">Portofolio</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}"><button class="btn btn-primary">Login</button></a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container px-4 px-lg-5 h-100">
                <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-8 align-self-end">
                        <h1 class="text-white font-weight-bold">HALLO</h1>
                        <hr class="divider" />
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <p class="text-white-75 mb-5">Selamat datang di Sistem Informasi Konsultasi</p>
                        <a class="btn btn-primary btn-xl" href="#about">Lihat Lebih</a>
                    </div>
                </div>
            </div>
        </header>
        <!-- About-->
        <section class="page-section bg-primary" id="about">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="text-white mt-0">Sistem Informasi Konsultasi dan Laporan Kemajuan Studi dengan Menggunakan QR Code di Jurusan Teknik Elektro Politeknik Negeri Manado </h2>
                        <hr class="divider divider-light" />
                        <p class="text-white-75 mb-4">sebuah platform digital yang dirancang untuk memfasilitasi komunikasi antara mahasiswa dan dosen pembimbing, serta memantau dan mengevaluasi kemajuan akademik mahasiswa secara efisien dan transparan.</p>
                        <a class="btn btn-light btn-xl" href="#services">Mulai!</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Services-->
        <section class="page-section" id="services">
            <div class="container px-4 px-lg-5">
                <h2 class="text-center mt-0">Kelebihan</h2>
                <hr class="divider" />
                <div class="row gx-4 gx-lg-5">
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-gem fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">Monitoring dan Evaluasi</h3>
                            <p class="text-muted mb-0">Memungkinkan dosen pembimbing dan institusi pendidikan untuk memantau dan mengevaluasi progres akademik mahasiswa</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-laptop fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">Fasilitasi Konsultasi</h3>
                            <p class="text-muted mb-0">menyediakan platform untuk konsultasi antara mahasiswa dan dosen pembimbing.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-globe fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">Penyimpanan dan Akses</h3>
                            <p class="text-muted mb-0">dapat membuat, menyimpan, dan mengakses laporan kemajuan studi mereka secara digital!</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-heart fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">Penilaian dan Feedback</h3>
                            <p class="text-muted mb-0">memberikan penilaian dan feedback langsung pada laporan kemajuan studi mahasiswa.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Portfolio-->
        <div id="portfolio">
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="#" title="Project Name">
                            <img class="img-fluid" src="{{ asset('NiceAdmin/assets/img/gambarPoli.jpg') }}" alt="..." />
                            <div class="portfolio-box-caption">
                                <div class="project-category text-white-50">SISTEM</div>
                                <div class="project-name"></div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="#" title="Project Name">
                            <img class="img-fluid" src="{{ asset('NiceAdmin/assets/img/gambarPoli2.jpeg') }}" alt="..." />
                            <div class="portfolio-box-caption">
                                <div class="project-category text-white-50">INFORMASI</div>
                                <div class="project-name"></div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="assets/img/portfolio/fullsize/3.jpg" title="Project Name">
                            <img class="img-fluid" src="{{ asset('NiceAdmin/assets/img/gambarPoli3.jpg') }}" alt="..." />
                            <div class="portfolio-box-caption">
                                <div class="project-category text-white-50">KONSULTASI</div>
                                <div class="project-name"></div>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </div>
        <!-- Call to action-->
        <section class="page-section bg-dark text-white">
            <div class="container px-4 px-lg-5 text-center">
                <h2 class="mb-4">Footer</h2>
                <a class="btn btn-light btn-xl" href="#page-top">kembali ke atas</a>
            </div>
        </section>
        
        <!-- Footer-->
        <footer class="bg-light py-5">
            <div class="container px-4 px-lg-5"><div class="small text-center text-muted">Copyright &copy; 2024 - Teknik Elektro Politeknik Negeri Manado</div></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- SimpleLightbox plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('NiceAdmin/assets/js/scripts.js') }}"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
