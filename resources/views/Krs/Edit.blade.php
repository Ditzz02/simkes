<!DOCTYPE html>
<html lang="en">
<head>
    @include('Template.head')
</head>
<body>
    @include('Template.navbar')
    @include('Template.sidebar')

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Detail KHS</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Home</a></li>
                    <li class="breadcrumb-item active">Detail KHS</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">Kartu Hasil Studi (KHS)</h5>

                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <table class="table mt-4">
                                <tr>
                                    <th>Nama</th>
                                    <td>{{ $mahasiswa->name }}</td>
                                </tr>
                                <tr>
                                    <th>NIM</th>
                                    <td>{{ $mahasiswa->nim }}</td>
                                </tr>
                                <tr>
                                    <th>Jurusan</th>
                                    <td>{{ $mahasiswa->jurusan }}</td>
                                </tr>
                                <tr>
                                    <th>Semester</th>
                                    <td>{{ $mahasiswa->semester }}</td>
                                </tr>
                            </table>

                            <h5 class="text-center">Mata Kuliah yang Diambil</h5>
                            <form method="POST" action="{{ route('update-krs', $mahasiswa->id) }}">
                                @csrf
                                <table class="table mt-4">
                                    <thead>
                                        <tr>
                                            <th>Mata Kuliah</th>
                                            <th>Nilai</th>
                                            <th>SKS</th>
                                            <th>Grade</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $totalSks = 0;
                                    @endphp
                                        @foreach($mahasiswa->mataKuliah as $mk)
                                        @php
                                        $totalSks += $mk->sks;
                                    @endphp
                                            <tr>
                                                <td>{{ $mk->nama_mk }}</td>
                                                <td>
                                                    <input type="number" name="nilai[{{ $mk->id }}]" value="{{ $mk->pivot->nilai }}" class="form-control">
                                                </td>
                                                <td>{{ $mk->sks }}</td>
                                                <td>{{ $grades[$mk->id] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="text-center my-3">
                                    <button type="submit" class="btn btn-primary">Simpan Nilai</button>
                                </div>
                            </form>

                            <table class="table mt-4">
                                <tr>
                                    <th>Total SKS</th>
                                    <td>{{$totalSks}}</td>
                                </tr>
                                <tr>
                                    <th>IPK</th>
                                    <td>{{ number_format($ipk, 2) }}</td>
                                </tr>
                            </table>
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
