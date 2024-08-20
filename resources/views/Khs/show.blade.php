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
            <h1>Kartu Hasil Studi (KHS) : {{ $mahasiswa->name }}</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body mt-2">
                                <form action="{{ route('tampil-khs', $mahasiswa->id) }}" method="GET">
                                    <div class="form-group mb-3">
                                        <label for="semester">Semester</label>
                                        <select class="form-control" id="semester" name="semester" onchange="this.form.submit()">
                                            @foreach($semesters as $semester)
                                                <option value="{{ $semester }}" {{ request('semester') == $semester ? 'selected' : '' }}>Semester {{ $semester }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </form>

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Mata Kuliah</th>
                                            <th>SKS</th>
                                            <th>Nilai</th>
                                            <th>Grade</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($krs as $item)
                                        <tr>
                                            <td>{{ $item->mataKuliah->nama_mk }}</td>
                                            <td>{{ $item->mataKuliah->sks }}</td>
                                            <td>{{ $item->nilai }}</td>
                                            <td>{{ $item->grade }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- Menampilkan total SKS di bawah tabel -->
                                <div class="mt-3">
                                    <p>Total SKS: {{ $totalSks }}</p>
                                    <p>Indeks Prestasi Semester (IPS): {{ number_format($ips, 2) }}</p>
                                    <p>Indeks Prestasi Kumulatif (IPK): {{ number_format($ipk, 2) }}</p>
                                </div>
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
