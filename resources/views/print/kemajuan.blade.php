<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kemajuan Studi</title>
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
            border: none; /* Hilangkan border */
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
            width: 70px;
            height: auto;
        }
        h5{
            margin: 10px 0;
            text-align: left;
            font-family: 'Times New Roman', serif;
        }
        .report-title {
            font-weight: bold;
            text-decoration: underline;
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
                <h3 class="report-title">LAPORAN KEMAJUAN STUDI</h3>
                @if(isset($semester))
                    Semester {{ $semester->name }}
                @else
                    <p>Semua Semester</p>
                @endif
            </center>
            
            <!-- Bagian A: Identitas Mahasiswa -->
            <h5 style="margin-left: 80px;">A. Identitas Mahasiswa</h5>
            <table class="student-info" style="border: none;">
                <tbody>
                    <tr>
                        <td class="label" style="border: none;">1. Nama Mahasiswa</td>
                        <td class="separator" style="border: none;">:</td>
                        <td class="value" style="border: none;">{{ $mahasiswa->name }}</td>
                    </tr>
                    <tr>
                        <td class="label" style="border: none;">2. NIM</td>
                        <td class="separator" style="border: none;">:</td>
                        <td class="value" style="border: none;">{{ $mahasiswa->nim }}</td>
                    </tr>
                    <tr>
                        <td class="label" style="border: none;">3. Tempat/Tanggal Lahir</td>
                        <td class="separator" style="border: none;">:</td>
                        <td class="value" style="border: none;">{{ $mahasiswa->tempat_lahir }}, {{ $mahasiswa->tanggal_lahir->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <td class="label" style="border: none;">4. Alamat</td>
                        <td class="separator" style="border: none;">:</td>
                        <td class="value" style="border: none;">{{ $mahasiswa->alamat }}</td>
                    </tr>
                    <tr>
                        <td class="label" style="border: none;">5. No HP</td>
                        <td class="separator" style="border: none;">:</td>
                        <td class="value" style="border: none;">{{ $mahasiswa->nomor_telepon }}</td>
                    </tr>
                    <tr>
                        <td class="label" style="border: none;">6. Email</td>
                        <td class="separator" style="border: none;">:</td>
                        <td class="value" style="border: none;">{{ $mahasiswa->email }}</td>
                    </tr>
                </tbody>
            </table>
            

            <br>
           <!-- Bagian B: Prestasi Mahasiswa -->
            <h5 style="margin-left: 80px;">B. Prestasi Mahasiswa</h5>
            <table class="student-info">
                <tbody>
                    @if($semester)
                        <tr>
                            <th style="text-align: center; width: 30%;">
                                <strong>IP Semester {{ $semester->id }}</strong>
                            </th>
                            <th style="text-align: center; width: 70%;">
                                <strong>IP Kumulatif s/d Semester {{ $semester->max('id') }}</strong>
                            </th>
                        </tr>
                        <tr>
                            <td style="text-align: center;">{{ number_format($ipSemester, 2) }}</td>
                            <td style="text-align: center;">{{ number_format($ipkKumulatif, 2) }}</td>
                        </tr>
                    @else
                        <tr>
                            <th style="text-align: center; width: 100%;">
                                <strong>IP Kumulatif s/d Semester {{ $mahasiswa->semesters->max('id') }}</strong>
                            </th>
                        </tr>
                        <tr>
                            <td style="text-align: center;" colspan="2">{{ number_format($ipkKumulatif, 2) }}</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            

            <br>
            <!-- Bagian C: Permasalahan dan Solusi -->
            <h5 style="margin-left: 80px;">C. Permasalahan dan Solusi</h5>
            <table class="issue-table">
                <thead>
                    <tr>
                        <th style="width: 5%;">No.</th>
                        <th style="width: 55%;">Permasalahan yang dihadapi selama proses pembelajaran</th>
                        <th style="width: 5%;">No.</th>
                        <th style="width: 35%;">Cara pemecahan masalah/solusi </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($konsultasi as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->permasalahan }}</td>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->solusi }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <br>
            <!-- Bagian D: Tanda Tangan -->
            <div class="signature-container">
                <div>
                    <br><br><br>
                    <p>Koord.Program Studi</p>
                    <img src="{{ asset('NiceAdmin/assets/img/kaprodi.png') }}" alt="QR Code Kaprodi">
                    <p class="name">{{ $kaprodi->name }}</p>
                    <p>NIP: {{ $kaprodi->nidn }}</p>
                </div>
                <div>
                    <p>Manado, {{ now()->format('d-m-Y') }}</p>
                        <br><p>Mengetahui,</p>
                    <p>Dosen Pembimbing</p>
                    <img src="{{ asset('NiceAdmin/assets/img/dosen.png') }}" alt="QR Code Dosen">
                    <p class="name">{{ $dosen->name }}</p>
                    <p>NIP: {{ $dosen->nidn }}</p>
                </div>
            </div>
    </div>
    <script>
        window.print();
    </script>
</body>
</html>
