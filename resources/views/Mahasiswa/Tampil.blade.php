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
            <h1>Detail Mahasiswa</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('profil',$mahasiswa->id) }}">Daftar Mahasiswa Bimbingan</a></li>
                    <li class="breadcrumb-item active">Detail Mahasiswa</li>
                </ol>
            </nav>
        </div>
        
        <section class="section profile">
            <div class="row">
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body pt-3">
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <h5 class="card-title">Detail Profil</h5>
                                    
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Nama Lengkap</div>
                                        <div class="col-lg-9 col-md-8">{{ $mahasiswa->name }}</div>
                                    </div>
                                
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8">{{ $mahasiswa->email }}</div>
                                    </div>
                                
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">NIM</div>
                                        <div class="col-lg-9 col-md-8">{{ $mahasiswa->nim }}</div>
                                    </div>
                                
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Jenis Kelamin</div>
                                        <div class="col-lg-9 col-md-8">{{ $mahasiswa->jenis_kelamin }}</div>
                                    </div>
                                
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Jurusan</div>
                                        <div class="col-lg-9 col-md-8">{{ $mahasiswa->jurusan }}</div>
                                    </div>
                                
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Semester</div>
                                        <div class="col-lg-9 col-md-8">{{ $mahasiswa->semester }}</div>
                                    </div>
                                
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Tanggal Lahir</div>
                                        <div class="col-lg-9 col-md-8">{{ $mahasiswa->tanggal_lahir->format('d m Y') }}</div>
                                    </div>
                                
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Alamat</div>
                                        <div class="col-lg-9 col-md-8">{{ $mahasiswa->alamat }}</div>
                                    </div>
                                
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Nomor Telepon</div>
                                        <div class="col-lg-9 col-md-8">{{ $mahasiswa->nomor_telepon }}</div>
                                    </div>
                                
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Nama Orang Tua</div>
                                        <div class="col-lg-9 col-md-8">{{ $mahasiswa->nama_orang_tua }}</div>
                                    </div>
                                
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Nomor Telepon Orang Tua</div>
                                        <div class="col-lg-9 col-md-8">{{ $mahasiswa->nomor_telepon_orang_tua }}</div>
                                    </div>
                                
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Status Keaktifan</div>
                                        <div class="col-lg-9 col-md-8">{{ $mahasiswa->status_keaktifan }}</div>
                                    </div>
                                
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Angkatan</div>
                                        <div class="col-lg-9 col-md-8">{{ $mahasiswa->angkatan }}</div>
                                    </div>
                                
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Foto</div>
                                        <div class="col-lg-9 col-md-8">
                                            <img src="{{ Storage::url($mahasiswa->foto) }}" style="width:100px" alt="Foto Mahasiswa" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End Bordered Tabs -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer" id="footer">
        @include('Template.footer')
    </footer>
    @include('Template.scripts')
</body>
</html>
