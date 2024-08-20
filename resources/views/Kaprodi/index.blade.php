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
            <h1>Daftar Permasalahan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Home</a></li>
                    <li class="breadcrumb-item active">Daftar Konsultasi</li>
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
                        <h5 class="card-title">Daftar Konsultasi</h5>
                        @if($konsultasi->isEmpty())
                            <p>Tidak ada konsultasi yang tersedia.</p>
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama Mahasiswa</th>
                                        <th>Nama Dosen</th>
                                        <th>Kegiatan</th>
                                        <th>Permasalahan</th>
                                        <th>Aksi</th>
                                        <th>Status Solusi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($konsultasi as $item)
                                        <tr>
                                            <td>{{ $item->mahasiswa->name }}</td>
                                            <td>{{ $item->dosen->name }}</td>
                                            <td>{{ $item->kegiatan }}</td>
                                            <td>{{ $item->permasalahan }}</td>
                                            <td>
                                                <a href="{{ route('kaprodi-show', $item->id) }}" class="btn btn-info btn-sm">Lihat Detail</a>
                                                @if(Auth::guard('kaprodi')->check() && $item->solusi_diberikan && !$item->status_persetujuan)
                                                    <a href="{{ route('kaprodi-approve', $item->id) }}" class="btn btn-success btn-sm">Setujui</a>
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->solusi_diberikan)
                                                    <span class="badge bg-success">Solusi Diberikan</span>
                                                @else
                                                    <span class="badge bg-warning">Belum Ada Solusi</span>
                                                @endif
                                                @if($item->status_persetujuan)
                                                    <span class="badge bg-primary">Disetujui</span>
                                                @endif
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
    <footer class="footer" id="footer">
        @include('Template.footer')
    </footer>
    @include('Template.scripts')
</body>
</html>
