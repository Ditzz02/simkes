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
            <h1>Detail Prodi</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('prodi') }}">Daftar Prodi</a></li>
                    <li class="breadcrumb-item active">Detail Prodi</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Detail Prodi</h5>
                        <p><strong>ID:</strong> {{ $prodi->id }}</p>
                        <p><strong>Nama Prodi:</strong> {{ $prodi->name }}</p>
                        <a href="{{ route('prodi-edit', $prodi->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('prodi-hapus', $prodi->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus prodi ini?')">Hapus</button>
                        </form>
                        <a href="{{ route('prodi') }}" class="btn btn-secondary">Kembali</a>
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
