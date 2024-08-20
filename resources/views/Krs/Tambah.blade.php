<!DOCTYPE html>
<html lang="en">

<head>
    @include('Template.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Update SKS total saat memilih mata kuliah
            $('#mata_kuliah_ids').on('change', 'input[name="mata_kuliah_ids[]"]', function() {
                let totalSks = 0;
                $('input[name="mata_kuliah_ids[]"]:checked').each(function() {
                    let sks = $(this).data('sks');
                    console.log('SKS: ', sks); // Debugging
                    totalSks += parseInt(sks);
                });
                console.log('Total SKS: ', totalSks); // Debugging
                $('#total_sks').text(totalSks);
            });

            // Filter mata kuliah berdasarkan semester
            $('#semester').on('change', function() {
                let selectedSemester = $(this).val();
                $('#mata_kuliah_ids tr').each(function() {
                    let mataKuliahSemester = $(this).find('input[type="checkbox"]').data('semester');
                    if (mataKuliahSemester == selectedSemester || selectedSemester == '') {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>
</head>

<body>

    <!-- ======= Navbar ======= -->
    @include('Template.navbar')

    <!-- ======= Sidebar ======= -->
    @include('Template.sidebar')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Tambah Kartu Rencana Studi (KRS)</h1>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tambah KRS</h5>
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form method="post" action="{{ route('simpan-krs') }}">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="mahasiswa_id">Mahasiswa</label>
                                    <select class="form-control" id="mahasiswa_id" name="mahasiswa_id" required>
                                        <option value="">Pilih Mahasiswa</option>
                                        @foreach ($mahasiswa as $mhs)
                                            <option value="{{ $mhs->id }}">{{ $mhs->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('mahasiswa_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="semester">Semester</label>
                                    <input type="number" class="form-control" id="semester" name="semester" required>
                                    @error('semester')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="mata_kuliah_ids">Mata Kuliah</label>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Mata Kuliah</th>
                                                <th>SKS</th>
                                                <th>Pilih</th>
                                            </tr>
                                        </thead>
                                        <tbody id="mata_kuliah_ids">
                                            @foreach ($mataKuliah as $mk)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $mk->nama_mk }}</td>
                                                    <td>{{ $mk->sks }}</td>
                                                    <td>
                                                        <input type="checkbox" name="mata_kuliah_ids[]" value="{{ $mk->id }}" data-sks="{{ $mk->sks }}" data-semester="{{ $mk->semester }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @error('mata_kuliah_ids')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label>Total SKS</label>
                                    <p id="total_sks">0</p>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
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
    
    @include('Template.scripts')
</body>

</html>
