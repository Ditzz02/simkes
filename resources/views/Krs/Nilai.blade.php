<!-- resources/views/nilai/tambah-nilai.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    @include('Template.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#semester').on('change', function() {
                let semester = $(this).val();
                let mahasiswaId = {{ $mahasiswa->id }};
                if (semester) {
                    $.ajax({
                        url: '{{ route('get-krs') }}',
                        type: 'GET',
                        data: {
                            mahasiswa_id: mahasiswaId,
                            semester: semester
                        },
                        success: function(response) {
                            $('#mata_kuliah_list').html(response);
                        }
                    });
                } else {
                    $('#mata_kuliah_list').empty();
                }
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
            <h1>Tambah Nilai Mata Kuliah - {{ $mahasiswa->nama }}</h1>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tambah Nilai Mata Kuliah</h5>
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('simpan-nilai') }}">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="semester">Semester</label>
                                    <input type="number" class="form-control" id="semester" name="semester" required>
                                    @error('semester')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label>Mata Kuliah</label>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Pilih</th>
                                                <th>Mata Kuliah</th>
                                                <th>SKS</th>
                                            </tr>
                                        </thead>
                                        <tbody id="mata_kuliah_list">
                                            <!-- Mata kuliah list will be loaded here via AJAX -->
                                        </tbody>
                                    </table>
                                    @error('mata_kuliah_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nilai">Nilai</label>
                                    <input type="number" class="form-control" id="nilai" name="nilai" min="0" max="100" required>
                                    @error('nilai')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <input type="hidden" name="mahasiswa_id" value="{{ $mahasiswa->id }}">
                                <input type="hidden" id="mata_kuliah_id" name="mata_kuliah_id">
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
