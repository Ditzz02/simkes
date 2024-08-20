<!-- resources/views/krs/input_nilai.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    @include('Template.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#mahasiswa_id').on('change', function() {
                let mahasiswaId = $(this).val();
                let semester = $('#semester').val();
                if (mahasiswaId && semester) {
                    $.ajax({
                        url: '{{ route('get-krs') }}',
                        type: 'GET',
                        data: {
                            mahasiswa_id: mahasiswaId,
                            semester: semester
                        },
                        success: function(response) {
                            $('#matakuliah_list').html(response);
                        }
                    });
                } else {
                    $('#matakuliah_list').empty();
                }
            });

            $('#semester').on('change', function() {
                $('#mahasiswa_id').trigger('change');
            });
        });
    </script>
</head>

<body>

    @include('Template.navbar')
    @include('Template.sidebar')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Input Nilai Mahasiswa</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Input Nilai Mahasiswa</h5>
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('nilai-simpan') }}">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="mahasiswa_id">Mahasiswa</label>
                                    <select class="form-control" id="mahasiswa_id" name="mahasiswa_id" required>
                                        <option value="">Pilih Mahasiswa</option>
                                        @foreach ($mahasiswa as $mhs)
                                            <option value="{{ $mhs->id }}">{{ $mhs->nama }}</option>
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
                                    <label>Mata Kuliah</label>
                                    <div id="matakuliah_list">
                                        <!-- Daftar mata kuliah akan dimuat di sini melalui AJAX -->
                                    </div>
                                    @error('matakuliah_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan Nilai</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>

    <footer id="footer" class="footer">
        @include('Template.footer')
    </footer><!-- End Footer -->
    @include('Template.scripts')
</body>

</html>
