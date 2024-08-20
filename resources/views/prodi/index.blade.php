<!DOCTYPE html>
<html lang="id">
<head>
    @include('Template.head')
</head>
<body>
    @include('Template.navbar')
    @include('Template.sidebar')

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Daftar Prodi</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Home</a></li>
                    <li class="breadcrumb-item active">Daftar Prodi</li>
                </ol>
            </nav>
        </div>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('prodi-tambah') }}" class="btn btn-primary mb-3 mt-3">Tambah Prodi</a>
                        @if($prodis->isEmpty())
                            <p>Tidak ada data prodi.</p>
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Prodi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($prodis as $index=>$prodi)
                                        <tr>
                                            <td>{{ $index+1 }}</td>
                                            <td>{{ $prodi->name }}</td>
                                            <td>
                                                <a href="{{ route('prodi-show', $prodi->id) }}" class="btn btn-info btn-sm">Lihat</a>
                                                <a href="{{ route('prodi-edit', $prodi->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('prodi-hapus', $prodi->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus prodi ini?')">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        @include('Template.footer')
    </footer><!-- End Footer -->

    @include('Template.scripts')
</body>
</html>
