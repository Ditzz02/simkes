<!DOCTYPE html>
<html lang="en">

<head>
    @include('Template.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>

    <!-- ======= Navbar ======= -->
    @include('Template.navbar')

    <!-- ======= Sidebar ======= -->
    @include('Template.sidebar')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Edit Dosen</h1>
            <nav>
                <ol class="breadcrumb">
                    {{ Breadcrumbs::render('edit_dosen') }}
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Edit Data Dosen</h5>

                            <form method="POST" action="{{ route('update_dosen', ['id' => $dosen->id]) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group mb-3">
                                    <label for="nidn">NIDN</label>
                                    <input type="text" class="form-control @error('nidn') is-invalid @enderror" id="nidn" name="nidn" value="{{ old('nidn', $dosen->nidn) }}" required>
                                    @error('nidn')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $dosen->name) }}" required>
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $dosen->email) }}" required>
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" value="{{ old('jenis_kelamin',$dosen->jenis_kelamin) }}" required>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="jurusan">Jurusan</label>
                                    <input type="text" class="form-control @error('jurusan') is-invalid @enderror" id="jurusan" name="jurusan" value="{{ old('jurusan', $dosen->jurusan) }}" required>
                                    @error('jurusan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="jabatan">Jabatan</label>
                                    <input type="text" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan" value="{{ old('jabatan', $dosen->jabatan) }}" required>
                                    @error('jabatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $dosen->tanggal_lahir) }}" required>
                                    @error('tanggal_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3" required>{{ old('alamat', $dosen->alamat) }}</textarea>
                                    @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="nomor_telepon">Nomor Telepon</label>
                                    <input type="text" class="form-control @error('nomor_telepon') is-invalid @enderror" id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon', $dosen->nomor_telepon) }}">
                                    @error('nomor_telepon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                                    <input type="text" class="form-control @error('pendidikan_terakhir') is-invalid @enderror" id="pendidikan_terakhir" name="pendidikan_terakhir" value="{{ old('pendidikan_terakhir', $dosen->pendidikan_terakhir) }}" required>
                                    @error('pendidikan_terakhir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="status_kepegawaian">Status Kepegawaian</label>
                                    <input type="text" class="form-control @error('status_kepegawaian') is-invalid @enderror" id="status_kepegawaian" name="status_kepegawaian" value="{{ old('status_kepegawaian', $dosen->status_kepegawaian) }}">
                                    @error('status_kepegawaian')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="foto">Foto</label>
                                    <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto">
                                    @error('foto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @if ($dosen->foto)
                                        <img src="{{ asset('storage/'.$dosen->foto) }}" alt="" style="width: 100px; height: auto; margin-top: 10px;">
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('daftar_dosen') }}" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
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
