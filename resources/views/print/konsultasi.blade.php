<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Konsultasi</title>
    <style>
        html {
            min-height: 100%;
        }
        body {
            margin: 0;
            font-family: 'Times New Roman', serif;
            color: #333;
            background-color: #f9f9f9;
            text-align: left;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }
        img {
            width: 55px;
            height: auto;
            margin: 0;
        }
        .signature-container p {
            margin: 0;
        }
        .signature-container .name {
            text-decoration: underline;
        }

        @media print {
            body * {
                visibility: hidden;
            }
            .printable, .printable * {
                visibility: visible;
            }
            .printable {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                text-align: center;
            }
            .printable img {
                width: 55px;
                height: auto;
                margin: 0;
            }
            .printable .signature-container {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-top: 20px;
            }
            .printable .signature-container div {
                text-align: center;
                width: 45%;
            }
            .printable .student-info, .printable .issue-table {
                margin: 20px auto;
                padding: 5px;
                border: 1px solid #000;
                border-collapse: collapse;
                width: 80%;
                font-size: 12px;
            }
            .printable .student-info td, .printable .issue-table th, .printable .issue-table td {
                padding: 5px;
                border: 1px solid #000;
            }
            .printable .student-info .label {
                width: 30%;
                text-align: left;
                font-weight: bold;
            }
            .printable .student-info .separator {
                text-align: center;
                width: 10%;
            }
            .printable .student-info .value {
                width: 60%;
                text-align: left;
            }
        }
        .student-info .value {
            width: 60%;
            text-align: left;
        }
        .student-info .separator {
            text-align: center;
            width: 10%;
        }
        .student-info .label {
            width: 30%;
            text-align: left;
            font-weight: bold;
        }
        .student-info td {
            padding: 5px;
            border: 1px solid #000; /* Add border */
        }
        .signature-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .student-info {
            margin: 20px auto;
            padding: 5px;
            border: 1px solid #000;
            border-collapse: collapse;
            width: 80%;
            font-size: 12px;
        }
        .signature-container div {
            text-align: center;
            width: 45%;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            font-family: 'Times New Roman', serif;
            font-size: 14px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        h1, h2, h3, h4 {
            margin: 10px 0;
            text-align: center;
            font-family: 'Times New Roman', serif;
        }
        .kop-table {
            border: double 3px black;
        }
        .signature-container img {
            width: 70px; /* Adjusted size for better print alignment */
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="printable">
            <table class="kop-table" width="100%">
                <tbody>
                    <tr>
                        <td style="border-right-color:transparent;" align="center" width="100">
                            <img src="{{ asset('img/Logo_Polimdo.png') }}" width="75" height="75" alt="Logo">
                        </td>
                        <td style="border-right-color:transparent;" colspan="5" align="center">
                            <h2 style="font-size: 30pt; white-space: nowrap; margin-right: 50px;">POLITEKNIK NEGERI MANADO</h2>
                        </td>
                    </tr>
                    <tr>
                        <th align="center" style="font-size: initial;font-weight: bold;">FORMULIR</th>
                        <th align="center" style="font-weight: bold;">FM-048 ed.A rev.1</th>
                        <th align="center" style="font-weight: bold;">ISSUE : A</th>
                        <th style="font-weight: bold;">Issued: 31-01-2007</th>
                        <th style="font-weight: bold;">UPDATE : 1</th>
                        <th style="white-space: nowrap;font-weight: bold;">Updated : 10-01-2019</th>
                    </tr>
                </tbody>
            </table>

            <center>
                <h3 class="report-title">DAFTAR KONSULTASI <br> PEMBIMBINGAN AKADEMIK</h3>
                @if(isset($semester))
                    Semester {{ $semester->name }}
                @else
                    <p>Semua Semester</p>
                @endif
            </center>

            <br>
            <table class="student-info">
                @foreach($konsultasi->groupBy('mahasiswa_id') as $mahasiswa_id => $items)
                    @php
                        $mahasiswa = $items->first()->mahasiswa;
                    @endphp
                    <tbody>
                        <tr>
                            <td class="label">Nama Mahasiswa</td>
                            <td class="separator">:</td>
                            <td class="value">{{ $mahasiswa->name }}</td>
                        </tr>
                        <tr>
                            <td class="label">NIM</td>
                            <td class="separator">:</td>
                            <td class="value">{{ $mahasiswa->nim }}</td>
                        </tr>
                        <tr>
                            <td class="label">Tempat/Tanggal Lahir</td>
                            <td class="separator">:</td>
                            <td class="value">{{ $mahasiswa->tempat_lahir }}, {{ $mahasiswa->tanggal_lahir->format('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <td class="label">Alamat <br></td>
                            <td class="separator">:</td>
                            <td class="value">{{ $mahasiswa->alamat }}</td>
                        </tr>
                        <tr>
                            <td class="label">No HP</td>
                            <td class="separator">:</td>
                            <td class="value">{{ $mahasiswa->nomor_telepon }}</td>
                        </tr>
                        <tr>
                            <td class="label">Email</td>
                            <td class="separator">:</td>
                            <td class="value">{{ $mahasiswa->email }}</td>
                        </tr>
                    </tbody>
                @endforeach
            </table>

            <br>
            <table>
                <thead>
                    <tr>
                        <th>TANGGAL</th>
                        <th>KEGIATAN MAH SAAT INI</th>
                        <th>PERMASALAHAN</th>
                        <th>SOLUSI</th>
                        <th>TANDA TANGAN</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($konsultasi as $item)
                        <tr>
                            <td>{{ $item->created_at->format('d-m-Y') }}</td>
                            <td>{{ $item->kegiatan }}</td>
                            <td>{{ $item->permasalahan }}</td>
                            <td>{{ $item->solusi }}</td>
                            <td>
                                @if($item->qr_code)
                                    <img src="{{ Storage::url($item->qr_code) }}" alt="QR Code" style="display: block; margin: auto;">
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="signature-container">
                <div>
                    <br> <br>
                    <p>Mengetahui : <br>
                    Koodinator Program Studi,</p>
                    <img src="{{ asset('NiceAdmin/assets/img/kaprodi.png') }}" alt="QR Code Kaprodi"><br>
                    <span class="name">{{ $dosenKaprodi->name }}</span> <br>
                    NIP. {{ $dosenKaprodi->nidn }}
                </div>
                <div>
                    <p>Manado, {{ now()->format('d-m-Y') }} <br> <br> <br>
                    Dosen Wali,</p>
                    @if($dosenPembimbing)
                    <img src="{{ asset('NiceAdmin/assets/img/dosen.png') }}" alt="QR Code Dosen Pembimbing"> <br>
                    <span class="name">{{ $dosenPembimbing->name }}</span> <br>
                    NIP. {{ $dosenPembimbing->nidn }}
                    @else
                        <p>Data dosen pembimbing tidak tersedia.</p>
                    @endif
                </div>
            </div>            
        </div>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>
