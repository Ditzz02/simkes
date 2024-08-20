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
      <h1>Mahasiswa</h1>
      <nav>
        <ol class="breadcrumb">
          {{ Breadcrumbs::render('daftar_mahasiswa') }}
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <!-- Content here -->
      </div>
    </section>

    <section class="section">
      <div class="row">
        <div class="col-lg-15">

          <div class="card">
            <div class="card-body">
              <div class="row row justify-content-center align-items-center">
                <div class="col-sm">
                    <h5 class="card-title">Daftar Mahasiswa</h5>
                </div>
                <div class="col-sm-3 d-flex py-3 justify-content-end">
                    <a href="{{ route('tambah_mahasiswa') }}"><button class="btn btn-primary rounded-pill">Tambah</button></a>
                </div>
                <div class="col-sm-3 d-flex py-3">
                    <form class="d-flex" method="GET" action="{{ route('daftar_mahasiswa') }}">
                        <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search" value="{{ request('search') }}">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
              </div>
              <!-- Default Table -->
              <table class="table table-striped data_table">
                <div class="datatable-container">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">NIM</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Program Studi</th>
                      <th scope="col">Foto</th>
                      <th scope="col">Tindakan</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($mahasiswa as $index => $m) 
                    <tr>
                      <th scope="row">{{ $offset + $index + 1 }}</th>
                      <td>{{ $m->nim }}</td>
                      <td>{{ $m->name }}</td>
                      <td>{{ $m->prodi }}</td>
                      <td>
                        @if ($m->foto)
                        <img src="{{ asset('storage/'.$m->foto) }}" alt="Foto" style="width: 35px; height: auto;">
                        @else
                          <span>Tidak ada foto</span>
                        @endif
                      </td>
                      
                      <td>
                        <div class="d-flex">
                          <a href="{{ route('edit_mahasiswa', ['id' => $m->id]) }}" class="btn btn-warning">
                              <i class="ri-edit-2-fill"></i>
                          </a>
                          </button>
                          <button type="button" class="btn btn-danger delete-button" data-id="{{ $m->id }}">
                            <i class="ri-delete-bin-3-line"></i>
                          </button>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </div>
              </table>
              <div class="datatable-info">
                {{ $mahasiswa->links('pagination::bootstrap-5') }}
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>
  </main><!-- End #main -->

  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data Mahasiswa</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="post" action="{{ route('update_mahasiswa', ['id' => 0]) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-2">
                        <label for="nim">NIM</label>
                        <input type="text" class="form-control" id="modalNim" name="nim" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="modalName" name="name" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="modalEmail" name="email" required>
                    </div>
                    <div class="form-group mb-2">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
    $(document).ready(function(){
        // Fill modal with data on button click
        $('.edit-button').on('click', function() {
            var id = $(this).data('id');
            var nim = $(this).data('nim');
            var name = $(this).data('name');
            var email = $(this).data('email');
            
            $('#modalNim').val(nim);
            $('#modalName').val(name);
            $('#modalEmail').val(email);
            
            $('#editForm').attr('action', '/mahasiswa/update/' + id);
        });
    });
  </script> 

  <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.delete-button').forEach(function(button) {
            button.addEventListener('click', function() {
                const mahasiswaId = button.getAttribute('data-id');
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
                        fetch(`/mahasiswa/hapus/${mahasiswaId}`, {
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
                                Swal.fire('Dihapus!', 'Mahasiswa telah dihapus.', 'success').then(() => {
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

</body>

</html>
