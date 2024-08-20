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
      <h1>Tambah Mata Kuliah</h1>
      <nav>
        <ol class="breadcrumb">
          {{ Breadcrumbs::render('tambah_mk') }}
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-8">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Form Tambah Mata Kuliah</h5>

              <!-- General Form Elements -->
              <form method="post" action="{{ route('simpan_mk') }}">
                @csrf
                <div class="row mb-3">
                  <label for="kode_mk" class="col-sm-2 col-form-label">Kode MK</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="kode_mk" name="kode_mk" value="{{ old('kode_mk') }}" required>
                    @if ($errors->has('kode_mk'))
                        <span class="text-danger">{{ $errors->first('kode_mk') }}</span>
                    @endif
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="nama_mk" class="col-sm-2 col-form-label">Nama MK</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama_mk" name="nama_mk" value="{{ old('nama_mk') }}" required>
                    @if ($errors->has('nama_mk'))
                        <span class="text-danger">{{ $errors->first('nama_mk') }}</span>
                    @endif
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="sks" class="col-sm-2 col-form-label">SKS</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="sks" name="sks" value="{{ old('sks') }}" required>
                    @if ($errors->has('sks'))
                        <span class="text-danger">{{ $errors->first('sks') }}</span>
                    @endif
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="semester" class="col-sm-2 col-form-label">Semester</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="semester" name="semester" value="{{ old('semester') }}" required>
                    @if ($errors->has('semester'))
                        <span class="text-danger">{{ $errors->first('semester') }}</span>
                    @endif
                  </div>
                </div>

                <div class="form-group mb-2">
                  <label for="prodi_id" class="mb-2">Program Studi</label>
                  <select class="form-control" id="prodi_id" name="prodi_id" required>
                      <option value="">Pilih Program Studi</option>
                      @foreach($prodis as $prodi)
                          <option value="{{ $prodi->id }}">{{ $prodi->name }}</option>
                      @endforeach
                  </select>
                  @if ($errors->has('prodi_id'))
                      <span class="text-danger">{{ $errors->first('prodi_id') }}</span>
                  @endif
              </div>

                <div class="row mb-3">
                  <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('daftar_mk') }}" class="btn btn-secondary">Batal</a>
                  </div>
                </div>

              </form><!-- End General Form Elements -->

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
