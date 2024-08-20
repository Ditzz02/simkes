<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class KhsController extends Controller
{

    public function show($id)
    {
        $mahasiswa = Mahasiswa::find($id);

        // Mengambil semua semester yang dimiliki mahasiswa
        $semesters = Krs::where('mahasiswa_id', $id)->pluck('semester')->unique()->sort();

        $selectedSemester = request('semester') ?? $semesters->first();

        $krs = Krs::where('mahasiswa_id', $id)
                ->where('semester', $selectedSemester)
                ->get();

        $ips = $this->hitungIPS($id, $selectedSemester);
        $ipk = $this->hitungIPK($id);

        // Hitung total SKS
        $totalSks = $krs->sum(function($item) {
            return $item->mataKuliah->sks;
        });

        // Tambahkan grade ke dalam setiap item KRS
        foreach ($krs as $item) {
            $item->grade = $this->convertToGrade($item->nilai)['grade'];
        }

        return view('khs.show', compact('mahasiswa', 'krs', 'ips', 'ipk', 'totalSks', 'semesters'));
    }

    public function hitungIPK($mahasiswaId)
    {
        // Dapatkan jumlah semester yang telah ditempuh mahasiswa
        $jumlahSemester = Krs::where('mahasiswa_id', $mahasiswaId)
            ->distinct('semester')
            ->count('semester');
    
        // Jika mahasiswa belum memiliki KRS, maka IPK adalah 0
        if ($jumlahSemester == 0) {
            return 0;
        }
    
        $totalIps = 0;
    
        // Hitung IPS untuk setiap semester dan tambahkan ke total
        for ($semester = 1; $semester <= $jumlahSemester; $semester++) {
            $totalIps += $this->hitungIPS($mahasiswaId, $semester);
        }
    
        // Hitung IPK sebagai rata-rata dari IPS per semester
        $ipk = $totalIps / $jumlahSemester;
    
        return $ipk;
    }

    public function hitungIPS($mahasiswaId, $semester)
    {
        $krs = Krs::where('mahasiswa_id', $mahasiswaId)
            ->where('semester', $semester)
            ->get();
        $totalSks = 0;
        $totalNilai = 0;

        foreach ($krs as $item) {
            $totalSks += $item->mataKuliah->sks;
            $totalNilai += $this->convertToGrade($item->nilai)['point'] * $item->mataKuliah->sks;
        }

        $ips = $totalSks > 0 ? $totalNilai / $totalSks : 0;
        return $ips;
    }

    public function tampil()
    {
        $mahasiswa = Mahasiswa::all(); // Mengambil semua data mahasiswa
        return view('khs.daftar', compact('mahasiswa'));
    }
    
    private function convertToGrade($nilai)
    {
        if ($nilai >= 85) return ['grade' => 'A', 'point' => 4];
        if ($nilai >= 75) return ['grade' => 'B', 'point' => 3];
        if ($nilai >= 65) return ['grade' => 'C', 'point' => 2];
        if ($nilai >= 50) return ['grade' => 'D', 'point' => 1];
        return ['grade' => 'E', 'point' => 0];
    }
}



