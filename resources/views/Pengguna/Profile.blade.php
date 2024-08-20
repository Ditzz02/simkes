<!DOCTYPE html>
<html lang="en">

<head>
    @include('Template.head')
    <style>
        .profile-picture {
            width: 150px; /* Atur lebar sesuai kebutuhan */
            height: 120px; /* Atur tinggi sesuai kebutuhan */
            object-fit: cover; /* Memastikan gambar tidak terdistorsi */
            border-radius: 50%; /* Membuat gambar menjadi bulat */
            display: block; /* Menghindari masalah display inline */
            border: none;
        }
    </style>
    <script>
        
        function nilaiHuruf(nilai) {
            if (nilai >= 85) return 'A';
            else if (nilai >= 70) return 'B';
            else if (nilai >= 55) return 'C';
            else if (nilai >= 40) return 'D';
            else return 'E';
        }
    </script>
</head>

<body>

    @include('Template.navbar')
    @include('Template.sidebar')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Profil Pengguna</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/beranda">Home</a></li>
                    <li class="breadcrumb-item active">Profil Pengguna</li>
                </ol>
            </nav>
        </div>

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                            <img src="{{ Auth::user()->level === 'Admin' ? asset('NiceAdmin/assets/img/profile-img.jpg') : asset('storage/'. Auth::user()->foto) }}" alt="" class="profile-picture">
                            <h2>{{ $user->name }}</h2>
                            <h3>{{ $user->jurusan }}</h3>
                        </div>
                    </div>

                </div>

                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Profil</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profil</button>
                                </li>

                                @if(Auth::guard('mahasiswa')->check())
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-khs">KHS</button>
                                </li>
                                @endif
                                @if(Auth::user()->level === 'Dosen')
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-bimbingan">Bimbingan</button>
                                </li>
                                @endif

                            </ul>
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <h5 class="card-title">Detail Profil</h5>
                                
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Nama Lengkap</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->name }}</div>
                                    </div>
                                
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
                                    </div>
                                
                                    @if(Auth::guard('dosen')->check())
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">NIP</div>
                                            <div class="col-lg-9 col-md-8">{{ $user->nidn }}</div>
                                        </div>
                                
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Jenis Kelamin</div>
                                            <div class="col-lg-9 col-md-8">{{ $user->jenis_kelamin }}</div>
                                        </div>
                                
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Alamat</div>
                                            <div class="col-lg-9 col-md-8">{{ $user->alamat }}</div>
                                        </div>
                                
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Nomor Telepon</div>
                                            <div class="col-lg-9 col-md-8">{{ $user->nomor_telepon }}</div>
                                        </div>
                                
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Pendidikan Terakhir</div>
                                            <div class="col-lg-9 col-md-8">{{ $user->pendidikan_terakhir }}</div>
                                        </div>
                                
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Jabatan</div>
                                            <div class="col-lg-9 col-md-8">{{ $user->jabatan }}</div>
                                        </div>
                                
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Status Kepegawaian</div>
                                            <div class="col-lg-9 col-md-8">{{ $user->status_kepegawaian }}</div>
                                        </div>
                                    @elseif(Auth::guard('mahasiswa')->check())
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">NIM</div>
                                            <div class="col-lg-9 col-md-8">{{ $user->nim }}</div>
                                        </div>
                                
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Jenis Kelamin</div>
                                            <div class="col-lg-9 col-md-8">{{ $user->jenis_kelamin }}</div>
                                        </div>
                                
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Alamat</div>
                                            <div class="col-lg-9 col-md-8">{{ $user->alamat }}</div>
                                        </div>
                                
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Jurusan</div>
                                            <div class="col-lg-9 col-md-8">{{ $user->jurusan }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Dosen Pembimbing</div>
                                            <div class="col-lg-9 col-md-8">
                                                {{ $dosen ? $dosen->dosen->name : 'Belum ada dosen pembimbing' }}
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                    <form method="post" action="{{ route('update_profile') }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="row mb-3">
                                            <label for="name" class="col-md-4 col-lg-3 col-form-label">Nama Lengkap</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ $user->name }}" required>
                                                @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ $user->email }}" required>
                                                @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        @if(Auth::guard('mahasiswa')->check() || Auth::guard('kaprodi')->check() || Auth::guard('dosen')->check())
                                        <div class="row mb-3">
                                            <label for="jenis_kelamin" class="col-md-4 col-lg-3 col-form-label">Jenis Kelamin</label>
                                            <div class="col-md-8 col-lg-9">
                                                <select class="form-select @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin " name="jenis_kelamin" value="{{ old('jenis_kelamin',$user->jenis_kelamin) }}" required>
                                                    <option value="Laki-laki">Laki-laki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                                @error('jenis_kelamin')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="foto" class="col-md-4 col-lg-3 col-form-label">Foto Profil</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto">
                                                @error('foto')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        @endif                                        
                                        <div class="row mb-3">
                                            <label for="password" class="col-md-4 col-lg-3 col-form-label">Password Baru</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" >
                                                @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </form>

                                </div>

                                @if(Auth::guard('mahasiswa')->check())
                                <div class="tab-pane fade profile-khs pt-3" id="profile-khs">
                                    <h5 class="card-title">Kartu Hasil Studi</h5>
                                    <form method="GET" action="{{ route('profil') }}">
                                        <div class="row mb-3">
                                            <label for="semester" class="col-md-2 col-form-label">Pilih Semester</label>
                                            <div class="col-md-4">
                                                <select class="form-select" name="semester" id="semester" onchange="this.form.submit()">
                                                    @foreach($semesters as $semester)
                                                        <option value="{{ $semester }}" {{ $semester == $selectedSemester ? 'selected' : '' }}>
                                                            Semester {{ $semester }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                
                                    <div class="card">
                                        <div class="card-body">
                                            @if($khs && $khs->isNotEmpty())
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Kode Mata Kuliah</th>
                                                        <th>Nama Mata Kuliah</th>
                                                        <th>SKS</th>
                                                        <th>Nilai</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        function nilaiHuruf($nilai)
                                                        {
                                                            if ($nilai >= 85) return 'A';
                                                            else if ($nilai >= 70) return 'B';
                                                            else if ($nilai >= 55) return 'C';
                                                            else if ($nilai >= 40) return 'D';
                                                            else return 'E';
                                                        }

                                                        function nilaiAngka($huruf)
                                                        {
                                                            switch ($huruf) {
                                                                case 'A':
                                                                    return 4;
                                                                case 'B':
                                                                    return 3;
                                                                case 'C':
                                                                    return 2;
                                                                case 'D':
                                                                    return 1;
                                                                case 'E':
                                                                    return 0;
                                                                default:
                                                                    return 0;
                                                            }
                                                        }

                                                        $totalSks = 0;
                                                        $totalNilai = 0;
                                                    @endphp

                                                    @foreach($khs as $item)
                                                        @php
                                                            $nilaiAngka = $item->nilai;
                                                            $nilaiHuruf = nilaiHuruf($nilaiAngka);
                                                            $nilaiPoint = nilaiAngka($nilaiHuruf);
                                                            $sks = $item->mataKuliah->sks ?? 0;
                                                            $totalSks += $sks;
                                                            $totalNilai += $sks * $nilaiPoint;
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $item->mataKuliah->kode_mk ?? 'N/A' }}</td>
                                                            <td>{{ $item->mataKuliah->nama_mk ?? 'N/A' }}</td>
                                                            <td>{{ $sks }}</td>
                                                            <td>{{ $nilaiHuruf }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                            <div class="mt-3">
                                                <p>Total SKS: {{ $totalSks }}</p>
                                                <p>IPS: {{ $totalSks ? round($totalNilai / $totalSks, 2) : 'N/A' }}</p>
                                            </div>
                                        @else
                                            <p>Tidak ada data KHS untuk semester ini.</p>
                                        @endif


                                        </div>
                                    </div>
                                </div>
                                @endif

                                <!-- Bagian Dosen -->
                                @if(Auth::user()->level === 'Dosen')
                                <div class="tab-pane fade profile-bimbingan pt-3" id="profile-bimbingan">
                                    <h5 class="card-title">Daftar Mahasiswa Bimbingan</h5>
                                    <div class="card">
                                        <div class="card-body">
                                            @if(isset($mahasiswa) && $mahasiswa->isNotEmpty())
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Nama Mahasiswa</th>
                                                            <th>Jurusan</th>
                                                            <th>Detail</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($mahasiswa as $mhs)
                                                        <tr>
                                                            <td>{{ $mhs->name }}</td>
                                                            <td>{{ $mhs->jurusan }}</td>
                                                            <td><a href="{{ route('tampil-mahasiswa', $mhs->id) }}" class="btn btn-info btn-sm">Lihat Detail</a></td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            @else
                                                <p>Tidak ada mahasiswa bimbingan.</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif

                            </div><!-- End Bordered Tabs -->

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        @include('Template.footer')
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    @include('Template.scripts')

</body>

</html>
