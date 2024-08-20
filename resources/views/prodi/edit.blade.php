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
            <h1>Edit Prodi</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('prodi') }}">Daftar Prodi</a></li>
                    <li class="breadcrumb-item active">Edit Prodi</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('prodi-update', $prodi->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Prodi</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{ $prodi->name }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('prodi') }}" class="btn btn-secondary">Kembali</a>
                        </form>
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
