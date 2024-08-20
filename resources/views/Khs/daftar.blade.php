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
            <h1>Kartu Hasil Studi (KHS)</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <h3>Daftar Mahasiswa</h3>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>NIM</th>
                                            <th>Nama</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($mahasiswa as $mhs)
                                        <tr>
                                            <td>{{ $mhs->nim }}</td>
                                            <td>{{ $mhs->name }}</td>
                                            <td>
                                                <a href="{{ route('tampil-khs', $mhs->id) }}" class="btn btn-primary">Lihat KHS</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
