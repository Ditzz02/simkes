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
            <h1>Atur Bimbingan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Home</a></li>
                    <li class="breadcrumb-item active">Atur Bimbingan</li>
                </ol>
            </nav>
        </div>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="row">
            <div class="col-lg-15">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <p>{{ $dosens->name }}</p>
                        </div>
                        <form action="{{ route('simpan-bimbingan', $dosens->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="mahasiswa_ids" class="form-label">Pilih Mahasiswa</label>
                                <select id="mahasiswa_ids" name="mahasiswa_ids[]" class="form-control" multiple>
                                    @foreach($mahasiswas as $mahasiswa)
                                        <option value="{{ $mahasiswa->id }}" @if($dosens->mahasiswa->contains($mahasiswa->id)) selected @endif>
                                            {{ $mahasiswa->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Tambahkan Mahasiswa</button>
                        </form>
                        
                        <!-- Daftar Mahasiswa yang Dibimbing -->
                        <div class="mt-4">
                            <h5>Daftar Mahasiswa yang Dibimbing oleh {{ $dosens->name }}</h5>
                            @if($dosens->mahasiswa->isEmpty())
                                <p>Tidak ada mahasiswa yang dibimbing oleh dosen ini.</p>
                            @else
                                <ul class="list-group">
                                    @foreach($dosens->mahasiswa as $mahasiswa)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $mahasiswa->name }} - {{ $mahasiswa->nim }}
                                            <form action="{{ route('hapus-bimbingan', ['dosen' => $dosens->id, 'mahasiswa' => $mahasiswa->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer id="footer" class="footer">
        @include('Template.footer')
    </footer>
    @include('Template.scripts')
</body>
</html>
