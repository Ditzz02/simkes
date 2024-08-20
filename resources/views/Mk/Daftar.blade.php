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
            <h1>Mata Kuliah</h1>
            <nav>
                <ol class="breadcrumb">
                    {{ Breadcrumbs::render('daftar_mk') }}
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                
            </div>
        </section>
        <section class="section">
            <div class="row">
                <div class="col-lg-15">

                    <div class="card">
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success m-2">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="row row justify-content-center align-items-center">
                                <div class="col-sm">
                                    <h5 class="card-title">Daftar Mata Kuliah</h5>
                                </div>
                                <div class="col-sm-3 d-flex py-3 justify-content-end">
                                    <button class="btn btn-primary rounded-pill" data-toggle="modal" data-target="#tambahModal">Tambah</button>
                                </div>
                                <div class="col-sm-3 d-flex py-3">
                                    <form class="d-flex" method="GET" action="{{ route('daftar_mk') }}">
                                        <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search" value="{{ request('search') }}">
                                        <button class="btn btn-outline-success" type="submit">Search</button>
                                    </form>
                                </div>
                            </div>
                            <!-- Default Table -->
                            <table class="table table-striped data_table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">
                                            <a href="{{ route('daftar_mk', ['sort' => 'kode_mk', 'order' => request('order') === 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}" style="color: black">
                                                Kode Mata Kuliah
                                                @if (request('sort') === 'kode_mk')
                                                    <i class="bi bi-chevron-{{ request('order') === 'asc' ? 'down' : 'up' }}"></i>
                                                @endif
                                            </a>
                                        </th>
                                        <th scope="col">
                                                Nama Mata Kuliah
                                        </th>
                                        <th scope="col">
                                            <a href="{{ route('daftar_mk', ['sort' => 'semester', 'order' => request('order') === 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}" style="color: black">
                                                Semester
                                                @if (request('sort') === 'semester')
                                                    <i class="bi bi-chevron-{{ request('order') === 'asc' ? 'down' : 'up' }}"></i>
                                                @endif
                                            </a>
                                        </th>
                                        <th scope="col">
                                            <a href="{{ route('daftar_mk', ['sort' => 'sks', 'order' => request('order') === 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}" style="color: black">
                                                SKS
                                                @if (request('sort') === 'sks')
                                                    <i class="bi bi-chevron-{{ request('order') === 'asc' ? 'down' : 'up' }}"></i>
                                                @endif
                                            </a>
                                        </th>
                                        <th scope="col">
                                            Prodi
                                         </th>
                                        <th scope="col">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mata_kuliah as $index => $mk)
                                    <tr>
                                        <th scope="row">{{ $offset + $index + 1 }}</th>
                                        <td>{{ $mk->kode_mk }}</td>
                                        <td>{{ $mk->nama_mk }}</td>
                                        <td>{{ $mk->semester }}</td>
                                        <td>{{ $mk->sks }}</td>
                                        <td>{{ $mk->prodi->name ?? 'tidak ada' }}</td>
                                        <td>
                                            <button class="btn btn-warning edit-button" data-toggle="modal" data-target="#editModal" data-id="{{ $mk->id }}" data-kode_mk="{{ $mk->kode_mk }}" data-nama_mk="{{ $mk->nama_mk }}" data-sks="{{ $mk->sks }}" data-semester="{{ $mk->semester }}">
                                                <i class="ri-edit-2-fill"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger delete-button" data-id="{{ $mk->id }}">
                                                <i class="ri-delete-bin-3-line"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="datatable-info">
                                {{ $mata_kuliah->appends(request()->query())->links('pagination::bootstrap-5') }}
                            </div>
                            
        
                            <!-- End Default Table Example -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

    <!-- Tambah Modal -->
    <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Tambah Mata Kuliah</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('simpan_mk') }}">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="kode_mk">Kode Mata Kuliah</label>
                            <input type="text" class="form-control" id="kode_mk" name="kode_mk" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="nama_mk">Nama Mata Kuliah</label>
                            <input type="text" class="form-control" id="nama_mk" name="nama_mk" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="semester">Semester</label>
                            <input type="number" class="form-control" id="semester" name="semester" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="sks">SKS</label>
                            <input type="number" class="form-control" id="sks" name="sks" required>
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
                        <div class="form-group mb-2">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Tambah Modal -->

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data Mata Kuliah</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="post" action="{{ route('update_mk', ['id' => 0]) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-2">
                            <label for="kode_mk">Kode Mata Kuliah</label>
                            <input type="text" class="form-control" id="modalKodeMK" name="kode_mk" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="nama_mk">Nama Mata Kuliah</label>
                            <input type="text" class="form-control" id="modalNamaMK" name="nama_mk" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="semester">Semester</label>
                            <input type="number" class="form-control" id="modalSemester" name="semester" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="sks">SKS</label>
                            <input type="number" class="form-control" id="modalSks" name="sks" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="prodi_id">Program Studi</label>
                            <select class="form-control" id="modalProdi_id" name="prodi_id" required>
                                @foreach($prodis as $prodi)
                                    <option value="{{ $prodi->id }}">{{ $prodi->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('prodi_id'))
                                <span class="text-danger">{{ $errors->first('prodi_id') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-2">
                            <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
            


    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        @include('Template.footer')
    </footer><!-- End Footer -->
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    @include('Template.scripts')
    <script>
        $(document).ready(function() {
        $('#tambahModal form').on('submit', function(event) {
            event.preventDefault();
            let form = $(this);
            let formData = form.serialize();
            
            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: formData,
                success: function(response) {
                    console.log(response); // Tambahkan ini untuk melihat respons dari server
                    if (response.success) {
                        Swal.fire('Berhasil!', 'Data berhasil disimpan.', 'success').then(() => {
                            $('#tambahModal form')[0].reset();
                            $('#tambahModal').modal('hide');
                            location.reload(); 
                        });
                    } else {
                        let errorMessages = '';
                        $.each(response.errors, function(key, value) {
                            errorMessages += value + '<br>';
                        });
                        Swal.fire('Gagal!', errorMessages, 'error');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // Tambahkan ini untuk melihat detail kesalahan
                    Swal.fire('Error!', 'Terjadi kesalahan saat menyimpan data.', 'error');
                }
            });
        });
    });
    </script>
    

    <script>
        $(document).ready(function(){
            // Fill modal with data on button click
            $('.edit-button').on('click', function() {
                var id = $(this).data('id');
                var kode_mk = $(this).data('kode_mk');
                var nama_mk = $(this).data('nama_mk');
                var semester = $(this).data('semester');
                var sks = $(this).data('sks');
                var prodi_id = $(this).data('prodi_id');

                $('#modalKodeMK').val(kode_mk);
                $('#modalNamaMK').val(nama_mk);
                $('#modalSemester').val(semester);
                $('#modalSks').val(sks);
                $('#modalProdi_id').val(prodi_id);

                $('#editForm').attr('action', '/mk/update/' + id);
            });
        });

    </script> 
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.delete-button').forEach(function(button) {
            button.addEventListener('click', function() {
                const mataKuliahId = button.getAttribute('data-id');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus dan tidak dapat dipulihkan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/mk/hapus/${mataKuliahId}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        }).then(response => {
                            return response.json();
                        }).then(data => {
                            if (data.success) {
                                Swal.fire('Dihapus!', 'Mata Kuliah telah dihapus.', 'success').then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire('Gagal!', data.error, 'error');
                            }
                        }).catch(error => {
                            Swal.fire('Error!', 'Terjadi kesalahan saat menghapus data.', 'error');
                        });
                    }
                });
            });
        });
    });
</script>

</html>
