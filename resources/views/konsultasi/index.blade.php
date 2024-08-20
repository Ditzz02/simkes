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
            <h1>Daftar Konsultasi</h1>
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

                        <!-- Dropdown Semester -->
                        @if(Auth::guard('mahasiswa')->check())
                            <div class="mb-3">
                                <label for="semester-select" class="form-label">Pilih Semester</label>
                                <select id="semester-select" class="form-control" onchange="filterBySemester()">
                                    <option value="" selected>Semua Semester</option>
                                    @foreach($semesters as $semester)
                                        <option value="{{ $semester->id }}">
                                            Semester {{ $semester->name }} ({{ ucfirst($semester->term) }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        @if($konsultasi->isEmpty())
                            <p>Tidak ada konsultasi yang tersedia.</p>
                        @else
                            <table class="table" id="konsultasi-table">
                                <thead>
                                    <tr>
                                        @if(Auth::guard('dosen')->check())
                                            <th>Nama Mahasiswa</th>
                                        @endif
                                        <th>Semester</th>
                                        <th>Kegiatan</th>
                                        <th>Permasalahan</th>
                                        <th>Aksi</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($konsultasi as $item)
                                        <tr data-semester-id="{{ $item->semester }}" data-solusi="{{ $item->solusi_diberikan }}" data-disetujui="{{ $item->status_persetujuan }}">
                                            @if(Auth::guard('dosen')->check())
                                                <td>{{ $item->mahasiswa->name }}</td>
                                            @endif
                                            <td>Semester {{ $item->semester }}</td>
                                            <td>{{ $item->kegiatan }}</td>
                                            <td>{{ $item->permasalahan }}</td>
                                            <td>
                                                <a href="{{ route('konsul-show', $item->id) }}" class="btn btn-info btn-sm"><i class="bx bxs-show"></i> Lihat Detail</a>
                                                @if(Auth::guard('mahasiswa')->check())
                                                @if(!$item->solusi_diberikan)
                                                    <form action="{{ route('konsul-delete', $item->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus konsultasi ini?')"><i class="bx bx-trash"></i> Hapus</button>
                                                    </form>
                                                @endif
                                                @endif
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
                            @if(Auth::guard('mahasiswa')->check())
                            <!-- Tombol cetak disini -->
                            <div id="print-buttons" class="d-flex" style="display: none;">
                                <!-- Form untuk Daftar Konsultasi -->
                                <form action="{{ route('konsul-print') }}" method="GET" target="_blank">
                                    <input type="hidden" name="semester" id="semester-id-konsultasi">
                                    <button type="submit" class="btn btn-warning m-3"><i class="bx bxs-printer"></i> Daftar Konsultasi</button>
                                </form>

                                <!-- Form untuk Kemajuan Studi -->
                                <form action="{{ route('studi-print') }}" method="GET" target="_blank">
                                    <input type="hidden" name="semester" id="semester-id-studi">
                                    <button type="submit" class="btn btn-danger m-3"><i class="bx bxs-printer"></i> Kemajuan Studi</button>
                                </form>
                            </div>
                            @endif

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

    <script>
        function filterBySemester() {
            var semesterId = document.getElementById('semester-select').value;
            console.log('Selected Semester ID:', semesterId); // Debugging
    
            // Perbarui input tersembunyi untuk cetak
            document.getElementById('semester-id-konsultasi').value = semesterId;
            document.getElementById('semester-id-studi').value = semesterId;
    
            var tableRows = document.querySelectorAll('#konsultasi-table tbody tr');
            var printButtons = document.getElementById('print-buttons');
            var canPrint = false;
    
            tableRows.forEach(row => {
                var rowSemesterId = row.getAttribute('data-semester-id');
                var solusiDiberikan = row.getAttribute('data-solusi') === '1';
                var disetujui = row.getAttribute('data-disetujui') === '1';
    
                if (semesterId === "" || rowSemesterId === semesterId) {
                    row.style.display = '';
                    if (solusiDiberikan && disetujui) {
                        canPrint = true;
                    }
                } else {
                    row.style.display = 'none';
                }
            });
    
            // Tampilkan atau sembunyikan tombol cetak
            printButtons.style.display = canPrint ? 'block' : 'none';
        }
    
        // Panggil filterBySemester untuk mengatur tombol cetak saat halaman pertama kali dimuat
        document.addEventListener('DOMContentLoaded', filterBySemester);
    </script>
    
</body>
</html>
