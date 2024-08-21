<?php

namespace App\Http\Controllers;

use App\Models\IPS;
use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    /**
     * Menampilkan Formulir Input Nilai
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil semua mahasiswa
        $mahasiswa = Mahasiswa::all();
        
        // Tampilkan view dengan data mahasiswa
        return view('Nilai.Daftar', compact('mahasiswa'));
    }

    /**
     * Mengambil Daftar KRS Berdasarkan Mahasiswa dan Semester
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function getKrs(Request $request)
{
    $mahasiswaId = $request->input('mahasiswa_id');
    $semester = $request->input('semester');

    if (!$mahasiswaId || !$semester) {
        return response()->json(['error' => 'Mahasiswa dan semester harus dipilih.'], 400);
    }

    $krsList = Krs::where('mahasiswa_id', $mahasiswaId)
                  ->where('semester', $semester)
                  ->with('mataKuliah')
                  ->get();

    return view('Krs.partials.mata_kuliah_list', compact('krsList'))->render();
}

    /**
     * Menyimpan Nilai untuk Mata Kuliah
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function simpanNilai(Request $request)
    {
        // Validasi input
        $request->validate([
            'mahasiswa_id' => 'required',
            'semester' => 'required',
            'nilai' => 'required|array',
            'nilai.*' => 'numeric|min:0|max:100',
        ]);

        // Loop melalui nilai yang dikirimkan
        foreach ($request->nilai as $mataKuliahId => $nilai) {
            // Cari KRS yang sesuai
            $krs = Krs::where('mahasiswa_id', $request->mahasiswa_id)
                      ->where('matakuliah_id', $mataKuliahId)
                      ->where('semester', $request->semester)
                      ->first();

            // Jika KRS ditemukan, simpan nilai
            if ($krs) {
                $krs->nilai = $nilai;
                $krs->save();
            }
        }

        return redirect()->back()->with('success', 'Nilai berhasil disimpan!');
    }

    public function convertToGrade($nilai)
    {
        if ($nilai >= 85) {
            return 'A';
        } elseif ($nilai >= 70) {
            return 'B';
        } elseif ($nilai >= 55) {
            return 'C';
        } elseif ($nilai >= 40) {
            return 'D';
        } else {
            return 'E';
        }
    }

    public function hitungIPS($mahasiswaId, $semester)
    {
        $nilaiKrs = Krs::where('mahasiswa_id', $mahasiswaId)
                    ->where('semester', $semester)
                    ->pluck('nilai');

        if ($nilaiKrs->count() > 0) {
            // Contoh konversi nilai ke grade poin, sesuaikan dengan kebijakan grading Anda
            $totalPoin = $nilaiKrs->map(function ($nilai) {
                if ($nilai >= 80) return 4.0;
                elseif ($nilai >= 70) return 3.0;
                elseif ($nilai >= 60) return 2.0;
                elseif ($nilai >= 50) return 1.0;
                else return 0.0;
            })->sum();

            $ips = $totalPoin / $nilaiKrs->count();

            IPS::updateOrCreate(
                ['mahasiswa_id' => $mahasiswaId, 'semester' => $semester],
                ['ips' => $ips]
            );
        }
    }
}
