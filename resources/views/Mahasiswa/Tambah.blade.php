<!DOCTYPE html>
<html lang="en">

<head>
    @include('Template.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    @include('Template.navbar')
    @include('Template.sidebar')

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Tambah Mahasiswa</h1>
            <nav>
                <ol class="breadcrumb">
                    {{ Breadcrumbs::render('tambah_mahasiswa') }}
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Form Tambah Mahasiswa</h5>

                            <form method="POST" action="{{ route('simpan_mahasiswa') }}" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="form-group mb-2">
                                    <label for="nim">NIM</label>
                                    <input type="text" class="form-control" id="nim" name="nim" required>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                        <option ></option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="jurusan">Jurusan</label>
                                    <input type="text" class="form-control" id="jurusan" name="jurusan" required>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="prodi">Prodi</label>
                                    <input type="text" class="form-control" id="prodi" name="prodi">
                                </div>

                                <div class="form-group mb-2">
                                    <label for="semester">Semester</label>
                                    <input type="text" class="form-control" id="semester" name="semester" required>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir">
                                </div>

                                <div class="form-group mb-2">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="nomor_telepon">Nomor Telepon</label>
                                    <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" >
                                </div>

                                <div class="form-group mb-2">
                                    <label for="nama_orang_tua">Nama Orang Tua</label>
                                    <input type="text" class="form-control" id="nama_orang_tua" name="nama_orang_tua">
                                </div>

                                <div class="form-group mb-2">
                                    <label for="nomor_telepon_orang_tua">Nomor Telepon Orang Tua</label>
                                    <input type="text" class="form-control" id="nomor_telepon_orang_tua" name="nomor_telepon_orang_tua">
                                </div>

                                <div class="form-group mb-2">
                                    <label for="angkatan">Angkatan</label>
                                    <input type="text" class="form-control" id="angkatan" name="angkatan" required>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="foto">Foto</label>
                                    <input type="file" class="form-control" id="foto" name="foto">
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        @include('Template.footer')
    </footer>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    @include('Template.scripts')
</body>
</html>
