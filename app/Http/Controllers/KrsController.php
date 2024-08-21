<?php

namespace App\Http\Controllers;

use App\Models\IPS;
use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class KrsController extends Controller
{
    public function create()
    {
        $mahasiswa = Mahasiswa::all();
        $mataKuliah = MataKuliah::all();
        return view('Krs.Tambah', compact('mahasiswa', 'mataKuliah'));
        
    }
    public function tambahNilai($mahasiswa_id)
    {
        $mahasiswa = Mahasiswa::find($mahasiswa_id);
        return view('Krs.Nilai', compact('mahasiswa'));
    }

    public function simpanNilai(Request $request)
{
    $request->validate([
        'mahasiswa_id' => 'required',
        'matakuliah_id' => 'required',  // Menggunakan nama yang konsisten
        'semester' => 'required',
        'nilai' => 'required|numeric|min:0|max:100',
    ]);

    // Pastikan menggunakan nama variabel yang konsisten
    $krs = Krs::where('mahasiswa_id', $request->mahasiswa_id)
                ->where('matakuliah_id', $request->matakuliah_id)  // Perbaiki nama kolom menjadi `mata_kuliah_id`
                ->where('semester', $request->semester)
                ->first();

    if ($krs) {
        // Nilai hanya tersimpan jika KRS ditemukan
        $krs->nilai = $request->nilai;
        $krs->save();
    }

    return redirect()->back()->with('success', 'Nilai berhasil disimpan!');
}

public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'mahasiswa_id' => 'required|exists:mahasiswa,id',
        'semester' => 'required|integer',
        'mata_kuliah_ids' => 'required|array',
        'mata_kuliah_ids.*' => 'exists:matakuliah,id',
    ]);

    // Cek dan simpan data KRS
    $errors = [];
    foreach ($request->mata_kuliah_ids as $mataKuliahId) {
        $exists = Krs::where('mahasiswa_id', $request->mahasiswa_id)
            ->where('matakuliah_id', $mataKuliahId)
            ->where('semester', $request->semester)
            ->exists();

        if ($exists) {
            $errors[] = "Mata kuliah dengan ID $mataKuliahId sudah ada untuk semester {$request->semester}.";
        } else {
            Krs::create([
                'mahasiswa_id' => $request->mahasiswa_id,
                'matakuliah_id' => $mataKuliahId,
                'semester' => $request->semester,
            ]);
        }
    }

    if (count($errors) > 0) {
        return redirect()->back()->withErrors($errors)->withInput();
    }

    // Redirect dengan pesan sukses
    return redirect()->route('tambah-krs')->with('success', 'KRS berhasil ditambahkan.');
}


    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        return view('Krs.Daftar', compact('mahasiswa'));
    }


    public function getMatakuliah(Request $request)
    {
        $semester = $request->input('semester');
        $mahasiswaId = $request->input('mahasiswa_id');

        $krs = Krs::where('mahasiswa_id', $mahasiswaId)
                ->where('semester', $semester)
                ->get();

        $mataKuliahIds = $krs->pluck('matakuliah_id')->toArray();

        $mataKuliah = MataKuliah::whereIn('id', $mataKuliahIds)->get();

        $output = '';
        foreach ($mataKuliah as $mk) {
            $output .= '<div class="form-check">
                            <input type="radio" class="form-check-input" name="mata_kuliah_id" value="' . $mk->id . '" data-sks="' . $mk->sks . '">
                            <label class="form-check-label">' . $mk->nama_mk . ' (' . $mk->sks . ' SKS)</label>
                        </div>';
        }

        return $output;
    }
    public function updateKrs(Request $request)
    {
        $krs = Krs::where('mahasiswa_id', $request->mahasiswa_id)->where('semester', $request->semester)->get();
        
        $totalSks = 0;
        $totalNilai = 0;

        foreach ($krs as $item) {
            $nilai = $this->convertToNumeric($item->nilai); // Fungsi untuk konversi nilai huruf ke angka
            $totalSks += $item->mata_kuliah->sks;
            $totalNilai += ($nilai * $item->mata_kuliah->sks);
        }

        $ips = $totalNilai / $totalSks;

        // Simpan IPS ke tabel IPS
        IPS::updateOrCreate(
            ['mahasiswa_id' => $request->mahasiswa_id, 'semester' => $request->semester],
            ['ips' => $ips]
        );

        // Update IPK Kumulatif
        $mahasiswa = Mahasiswa::find($request->mahasiswa_id);
        $ipsList = IPS::where('mahasiswa_id', $mahasiswa->id)->get();
        $totalIps = $ipsList->sum('ips');
        $totalSemesters = $ipsList->count();
        $ipk = $totalIps / $totalSemesters;

        $mahasiswa->update(['ipk' => $ipk]);

        return redirect()->back()->with('success', 'KRS dan IPS berhasil diperbarui.');
    }
}
