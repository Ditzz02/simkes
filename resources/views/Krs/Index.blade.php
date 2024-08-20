<!DOCTYPE html>
<html lang="en">

<head>
    @include('Template.head')
</head>

<body>

    <!-- ======= Navbar ======= -->
    @include('Template.navbar')

    <!-- ======= Sidebar ======= -->
    @include('Template.sidebar')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Daftar Kartu Rencana Studi (KRS)</h1>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Daftar KRS</h5>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Mahasiswa</th>
                                        <th scope="col">Mata Kuliah</th>
                                        <th scope="col">Semester</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($krs as $index => $item)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td>{{ $item->mahasiswa->name }}</td>
                                        <td>{{ $item->mataKuliah->nama_mk }}</td>
                                        <td>{{ $item->semester }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination">
                                {{ $krs->links() }}
                            </div>
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
