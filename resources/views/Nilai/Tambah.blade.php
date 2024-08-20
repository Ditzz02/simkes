<!DOCTYPE html>
<html lang="en">

<head>
    @include('Template.head')
</head>

<body>

    @include('Template.navbar')
    @include('Template.sidebar')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Tambah Nilai Mahasiswa</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/beranda">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('daftar_nilai') }}">Nilai</a></li>
                    <li class="breadcrumb-item active">Tambah Nilai</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Form Tambah Nilai</h5>

                            <!-- Floating Labels Form -->
                            <form method="post" action="{{ route('simpan_nilai') }}">
                                @csrf
                                <div class="row mb-3">
                                    <label for="mahasiswa_id" class="col-md-4 col-lg-3 col-form-label">Mahasiswa</label>
                                    <div class="col-md-8 col-lg-9">
                                        <select name="mahasiswa_id" class="form-select @error('mahasiswa_id') is-invalid @enderror" id="mahasiswa_id" required>
                                            <option value="" disabled selected>Pilih Mahasiswa</option>
                                            @foreach ($mahasiswa as $m)
                                                <option value="{{ $m->id }}">{{ $m->name }} ({{ $m->nim }})</option>
                                            @endforeach
                                        </select>
                                        @error('mahasiswa_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="matakuliah_id" class="col-md-4 col-lg-3 col-form-label">Mata Kuliah</label>
                                    <div class="col-md-8 col-lg-9">
                                        <select name="matakuliah_id" class="form-select @error('matakuliah_id') is-invalid @enderror" id="matakuliah_id" required>
                                            <option value="" disabled selected>Pilih Mata Kuliah</option>
                                            @foreach ($matakuliah as $mk)
                                                <option value="{{ $mk->id }}">{{ $mk->nama_mk }} ({{ $mk->kode_mk }})</option>
                                            @endforeach
                                        </select>
                                        @error('matakuliah_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="nilai" class="col-md-4 col-lg-3 col-form-label">Nilai</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="nilai" type="number" step="0.01" class="form-control @error('nilai') is-invalid @enderror" id="nilai" required>
                                        @error('nilai')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form><!-- End floating Labels Form -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>
    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        @include('Template.footer')
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    @include('Template.scripts')

</body>

</html>
