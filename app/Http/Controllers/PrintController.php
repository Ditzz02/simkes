<?php

namespace App\Http\Controllers;

use App\Models\IPS;
use App\Models\Krs;
use App\Models\Dosen;
use App\Models\Kaprodi;
use App\Models\Semester;
use App\Models\Mahasiswa;
use App\Models\Konsultasi;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PrintController extends Controller
{
    public function printDaftarKonsultasi(Request $request)
{
    // Mendapatkan mahasiswa yang sedang login
    $mahasiswa = Auth::user();

    $semesterId = $request->input('semester');

    // Query untuk mengambil data konsultasi
    $konsultasiQuery = Konsultasi::where('status_persetujuan', true)
                                ->where('mahasiswa_id', $mahasiswa->id) // Filter berdasarkan mahasiswa yang login
                                ->with('mahasiswa', 'dosen');

    if (!empty($semesterId)) {
        $konsultasiQuery->where('semester', $semesterId);
    }

    $konsultasi = $konsultasiQuery->get();

    // Menyaring dosen kepala prodi dan dosen pembimbing
    $dosenKaprodi = Kaprodi::where('prodi', 'Teknik Informatika')->first();

    // Dapatkan dosen pembimbing dari konsultasi pertama jika ada
    $dosenPembimbing = $konsultasi->first()->dosen ?? null;

    // Dapatkan informasi semester jika ada
    $semester = null;
    if (!empty($semesterId)) {
        $semester = Semester::find($semesterId);
    }

    // Mengembalikan view dengan data yang diperlukan
    return view('print.konsultasi', compact('konsultasi', 'dosenKaprodi', 'dosenPembimbing', 'semester'));
}

    public function printKemajuanStudi(Request $request)
{
    if (Auth::guard('mahasiswa')->check()) {
        $mahasiswa = Auth::guard('mahasiswa')->user();
        $semesterId = $request->input('semester');

        // Jika semester_id tidak ada, ambil semua data
        if ($semesterId) {
            $krs = Krs::with('mataKuliah')
                    ->where('mahasiswa_id', $mahasiswa->id)
                    ->where('semester', $semesterId)
                    ->get();

            $konsultasi = Konsultasi::where('mahasiswa_id', $mahasiswa->id)
                                    ->where('semester', $semesterId)
                                    ->whereNotNull('solusi')
                                    ->get();

            $semester = Semester::find($semesterId);
        } else {
            $krs = Krs::with('mataKuliah')
                    ->where('mahasiswa_id', $mahasiswa->id)
                    ->get();

            $konsultasi = Konsultasi::where('mahasiswa_id', $mahasiswa->id)
                                    ->whereNotNull('solusi')
                                    ->get();

            $semester = null; // Jika semua semester, biarkan null
        }

        // Debugging output
        Log::info('KRS Data:', $krs->toArray());
        Log::info('Konsultasi Data:', $konsultasi->toArray());

        // Calculate IP Semester
        $ipSemester = $this->calculateIPSemester($krs);

        // Calculate IPK Kumulatif
        $ipkKumulatif = $this->calculateIPKKumulatif($mahasiswa);

        // Retrieve dosen and kaprodi
        $dosen = $mahasiswa->dosen;
        $kaprodi = Kaprodi::first();

        if ($dosen instanceof \Illuminate\Database\Eloquent\Collection) {
            $dosen = $dosen->first();
        }

        if (!$kaprodi) {
            abort(404, 'Kaprodi not found');
        }

        return view('print.kemajuan', compact('mahasiswa', 'konsultasi', 'ipSemester', 'ipkKumulatif', 'dosen', 'kaprodi', 'semester'));
    } else {
        return redirect()->route('login');
    }
}



    private function calculateIPSemester($krs)
    {
        if ($krs->isEmpty()) {
            return 0;
        }

        $totalNilai = 0;
        $totalSKS = 0;

        foreach ($krs as $item) {
            $grade = $this->convertToGrade($item->nilai);
            $bobot = $this->convertGradeToBobot($grade);
            $totalNilai += $bobot * $item->mataKuliah->sks;
            $totalSKS += $item->mataKuliah->sks;
        }

        return $totalSKS > 0 ? round($totalNilai / $totalSKS, 2) : 0;
    }

    private function calculateIPKKumulatif($mahasiswa)
    {
        $krsItems = Krs::where('mahasiswa_id', $mahasiswa->id)->get();

        $totalSKS = 0;
        $totalNilaiSKS = 0;

        foreach ($krsItems as $item) {
            $grade = $this->convertToGrade($item->nilai);
            $bobot = $this->convertGradeToBobot($grade);

            $totalSKS += $item->mataKuliah->sks;
            $totalNilaiSKS += $bobot * $item->mataKuliah->sks;
        }

        return $totalSKS > 0 ? round($totalNilaiSKS / $totalSKS, 2) : 0;
    }

    private function convertToGrade($nilai)
    {
        if ($nilai >= 85) return 'A';
        if ($nilai >= 75) return 'B';
        if ($nilai >= 65) return 'C';
        if ($nilai >= 50) return 'D';
        return 'E';
    }

    private function convertGradeToBobot($grade)
    {
        switch ($grade) {
            case 'A': return 4;
            case 'B': return 3;
            case 'C': return 2;
            case 'D': return 1;
            default: return 0;
        }
    }
}



