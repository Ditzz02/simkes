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
            <h1>Ajukan Permasalahan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Home</a></li>
                    <li class="breadcrumb-item active">Ajukan Permasalahan</li>
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
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @if($hasDosenPembimbing)
                        <form action="{{ route('konsul-store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="semester" class="form-label mt-3">Semester</label>
                                <select id="semester" name="semester" class="form-control" required>
                                    <option value="" disabled selected>Pilih Semester</option>
                                    @foreach($semesters as $semester)
                                        <option value="{{ $semester->id }}">
                                            Semester {{ $semester->name }} ({{ ucfirst($semester->term) }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        
                            <div id="kegiatan-container">
                                <div class="kegiatan-item mb-3">
                                    <div class="mb-3">
                                        <label for="kegiatan" class="form-label">Kegiatan</label>
                                        <input type="text" name="kegiatan[]" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="permasalahan" class="form-label">Permasalahan</label>
                                        <textarea name="permasalahan[]" class="form-control" rows="4" required></textarea>
                                    </div>
                                </div>
                            </div>
                        
                            <button type="button" class="btn btn-success" id="add-more">Tambah Kegiatan & Permasalahan</button>
                            <button type="submit" class="btn btn-primary">Kirim Permasalahan</button>
                        </form>
                        
                        @else
                            <div class="alert alert-warning">
                                Anda tidak memiliki dosen pembimbing yang ditugaskan. Silakan hubungi admin untuk mendapatkan bimbingan.
                            </div>
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
        // Event listener untuk tombol "Tambah Kegiatan & Permasalahan"
        document.getElementById('add-more').addEventListener('click', function() {
            var kegiatanContainer = document.getElementById('kegiatan-container');
            var kegiatanItem = kegiatanContainer.querySelector('.kegiatan-item');
            
            // Clone existing kegiatan-item div
            var newKegiatanItem = kegiatanItem.cloneNode(true);
            
            // Clear existing values
            newKegiatanItem.querySelector('input').value = '';
            newKegiatanItem.querySelector('textarea').value = '';

            // Create a remove button for the new item
            var removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.className = 'btn btn-danger btn-sm remove-item';
            removeButton.textContent = 'Hapus';
            
            // Add event listener to remove button
            removeButton.addEventListener('click', function() {
                kegiatanContainer.removeChild(newKegiatanItem);
            });
            
            // Append the remove button to the new item
            var itemDiv = document.createElement('div');
            itemDiv.className = 'mb-3';
            itemDiv.appendChild(removeButton);
            newKegiatanItem.appendChild(itemDiv);

            // Append the new item to the container
            kegiatanContainer.appendChild(newKegiatanItem);
        });

        // Hide remove button on initial load
        document.querySelectorAll('.kegiatan-item').forEach(function(item, index) {
            if (index === 0) {
                item.querySelector('.remove-item')?.classList.add('d-none');
            }
        });
    </script>
</body>
</html>
