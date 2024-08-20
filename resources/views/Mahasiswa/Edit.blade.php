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
      <h1>Edit Mahasiswa</h1>
      <nav>
        <ol class="breadcrumb">
          {{ Breadcrumbs::render('edit_mahasiswa', $mahasiswa->id) }}
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Edit Data Mahasiswa</h5>

              <!-- Edit Form -->
              <form method="POST" action="{{ route('update_mahasiswa', ['id' => $mahasiswa->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group mb-3">
                  <label for="nim">NIM</label>
                  <input type="text" class="form-control @error('nim') is-invalid @enderror" id="nim" name="nim" value="{{ old('nim', $mahasiswa->nim) }}" required>
                  @error('nim')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                
                <div class="form-group mb-3">
                  <label for="name">Nama</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $mahasiswa->name) }}" required>
                  @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group mb-3">
                  <label for="email">Email</label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $mahasiswa->email) }}" required>
                  @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group mb-3">
                  <label for="jenis_kelamin">Jenis Kelamin</label>
                  <select class="form-select @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin " name="jenis_kelamin" value="{{ old('jenis_kelamin',$mahasiswa->jenis_kelamin) }}" required>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
                  @error('jenis_kelamin')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group mb-3">
                  <label for="jurusan">Jurusan</label>
                  <input type="text" class="form-control @error('jurusan') is-invalid @enderror" id="jurusan" name="jurusan" value="{{ old('jurusan', $mahasiswa->jurusan) }}" required>
                  @error('jurusan')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group mb-3">
                  <label for="semester">Semester</label>
                  <input type="text" class="form-control @error('semester') is-invalid @enderror" id="semester" name="semester" value="{{ old('semester', $mahasiswa->semester) }}" required>
                  @error('semester')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group mb-3">
                  <label for="tanggal_lahir">Tanggal Lahir</label>
                  <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $mahasiswa->tanggal_lahir) }}" required>
                  @error('tanggal_lahir')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group mb-3">
                  <label for="alamat">Alamat</label>
                  <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3" required>{{ old('alamat', $mahasiswa->alamat) }}</textarea>
                  @error('alamat')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group mb-3">
                  <label for="nomor_telepon">Nomor Telepon</label>
                  <input type="text" class="form-control @error('nomor_telepon') is-invalid @enderror" id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon', $mahasiswa->nomor_telepon) }}" >
                  @error('nomor_telepon')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group mb-3">
                  <label for="nama_orang_tua">Nama Orang Tua</label>
                  <input type="text" class="form-control" id="nama_orang_tua" name="nama_orang_tua" value="{{ old('nama_orang_tua', $mahasiswa->nama_orang_tua) }}" >
                  @error('nama_orang_tua')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group mb-3">
                  <label for="nomor_telepon_orang_tua">Nomor Telepon Orang Tua</label>
                  <input type="text" class="form-control" id="nomor_telepon_orang_tua" name="nomor_telepon_orang_tua" value="{{ old('nomor_telepon_orang_tua', $mahasiswa->nomor_telepon_orang_tua) }}" >
                  @error('nomor_telepon_orang_tua')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group mb-3">
                  <label for="angkatan">Angkatan</label>
                  <input type="text" class="form-control @error('angkatan') is-invalid @enderror" id="angkatan" name="angkatan" value="{{ old('angkatan', $mahasiswa->angkatan) }}" required>
                  @error('angkatan')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group mb-3">
                  <label for="foto">Foto (jika ingin diubah)</label>
                  <input type="file" class="form-control" id="foto" name="foto">
                  @error('foto')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                  @if ($mahasiswa->foto)
                      <img src="{{ asset('storage/'.$mahasiswa->foto) }}" alt="" style="width: 100px; height: auto; margin-top: 10px;">
                  @endif
                  @error('foto')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('daftar_mahasiswa') }}" class="btn btn-secondary">Batal</a>
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
