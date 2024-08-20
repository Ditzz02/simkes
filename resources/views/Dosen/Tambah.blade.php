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
            <h1>Tambah Dosen</h1>
            <nav>
                <ol class="breadcrumb">
                    {{ Breadcrumbs::render('tambah_dosen') }}
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Form Tambah Dosen</h5>

                            <form method="POST" action="{{ route('simpan_dosen') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="nidn">NIDN</label>
                                    <input type="text" class="form-control" id="nidn" name="nidn" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="foto">Foto</label>
                                    <input type="file" class="form-control" id="foto" name="foto">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="alamat">Alamat</label>
                                    <textarea type="text" class="form-control" id="alamat" name="alamat" required></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="jurusan">Jurusan</label>
                                    <input type="text" class="form-control" id="jurusan" name="jurusan" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="jabatan">Jabatan</label>
                                    <input type="text" class="form-control" id="jabatan" name="jabatan" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                                    <select class="form-select" id="pendidikan_terakhir" name="pendidikan_terakhir" required>
                                        <option ></option>
                                        <option value="S1">S1</option>
                                        <option value="S2">S2</option>
                                        <option value="S3">S3</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="status_kepegawaian">Status Kepegawaian</label>
                                    <select class="form-select" id="status_kepegawaian" name="status_kepegawaian" required>
                                        <option ></option>
                                        <option value="Tetap">Tetap</option>
                                        <option value="Kontrak">Kontrak</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nomor_telepon">Nomor Telepon</label>
                                    <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon">
                                </div>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    @include('Template.footer')
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    @include('Template.scripts')
</body>

</html>
