<!DOCTYPE html>
<html lang="id">
<head>
    @include('Template.head')
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            #print-qr-code, #print-qr-code * {
                visibility: visible;
            }
            #print-qr-code {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                text-align: center;
            }
            #print-qr-code img {
                width: 100%;
                max-width: 300px; /* Ukuran maksimum QR Code dalam inci */
                height: auto;
            }
        }
    </style>
</head>
<body>
    @include('Template.navbar')
    @include('Template.sidebar')

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Detail Permasalahan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('konsul-index') }}">Daftar Permasalahan</a></li>
                    <li class="breadcrumb-item active">Detail Permasalahan</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $konsultasi->topik }}</h5>
                        <p><strong>Mahasiswa:</strong> {{ $konsultasi->mahasiswa->name }}</p>
                        <p><strong>Dosen:</strong> {{ $konsultasi->dosen->name }}</p>
                        <p><strong>Permasalahan:</strong></p>
                        <p>{{ $konsultasi->permasalahan }}</p>
                        
                        @if($konsultasi->solusi)
                            <div class="mt-4">
                                <h5>Solusi:</h5>
                                <p>{{ $konsultasi->solusi }}</p>
                            </div>
                        @endif
                        @if($konsultasi->qr_code)
                            <div>
                                <button class="btn btn-success bx bxs-printer" onclick="printQRCode()">Print QR Code</button>
                            </div>
                            <div id="print-qr-code" style="display:none;">
                                <img src="{{ Storage::url($konsultasi->qr_code) }}" alt="QR Code">
                            </div>
                        @endif
                        <div class="mt-4">
                            <a href="{{ route('kaprodi-index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
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
        function printQRCode() {
            // Show QR code for printing
            var qrCodeDiv = document.getElementById('print-qr-code');
            qrCodeDiv.style.display = 'block';

            // Print the QR code
            window.print();

            // Hide QR code again
            qrCodeDiv.style.display = 'none';
        }
    </script>
</body>
</html>
