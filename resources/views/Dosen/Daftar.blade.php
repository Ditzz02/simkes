
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
      <h1>Dosen</h1>
      <nav>
        <ol class="breadcrumb">
          {{ Breadcrumbs::render('daftar_dosen') }}
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
                <div class="row row justify-content-center align-items-center">
                    <div class="col-sm">
                        <h5 class="card-title">Daftar Dosen</h5>
                    </div>
                    <div class="col-sm-3 d-flex py-3 justify-content-end">
                        <a href="{{ route('tambah_dosen') }}"><button class="btn btn-primary rounded-pill">Tambah</button></a>
                    </div>
                    <div class="col-sm-3 d-flex py-3">
                        <form class="d-flex" method="GET" action="{{ route('daftar_dosen') }}">
                            <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search" value="{{ request('search') }}">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>

              <!-- Default Table -->
              <table class="table table-striped data_table">
                <div class="datatable-container">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">NIP</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Email</th>
                      <th scope="col">Foto</th>
                      <th scope="col">Tindakan</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($dosen as $index => $d) 
                    <tr>
                      <th scope="row">{{ $offset + $index + 1 }}</th>
                      <td>{{ $d->nidn }}</td>
                      <td>{{ $d->name }}</td>
                      <td>{{ $d->email }}</td>
                      <td>
                        @if ($d->foto)
                        <img src="{{ asset('storage/'.$d->foto) }}" alt="foto" style="width: 35px; height: auto;">
                        @else
                          <span>Tidak ada foto</span>
                        @endif
                      </td>
                      <td>
                        <div class="d-flex">
                            <a href="{{ route('edit_dosen',$d->id) }}" class="btn btn-warning"><i class="bx bx-message-square-edit"></i></a>
                            <button type="button" class="btn btn-danger delete-button" data-id="{{ $d->id }}">
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
                {{ $dosen->links('pagination::bootstrap-5'); }}
              </div>
              
                
              <!-- End Default Table Example -->
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
<script>
  document.addEventListener('DOMContentLoaded', function() {
      document.querySelectorAll('.delete-button').forEach(function(button) {
          button.addEventListener('click', function() {
              const dosenId = button.getAttribute('data-id');
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
                      fetch(`/dosen/hapus/${dosenId}`, {
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
                              Swal.fire('Dihapus!', 'Dosen telah dihapus.', 'success').then(() => {
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