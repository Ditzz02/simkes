<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BimbinganController extends Controller
{
    public function index()
    {
        $dosen = Dosen::paginate(10);
        return view('Konsul.Daftar', compact('dosen'));
    }

    public function create($id)
    {
        // Temukan dosen berdasarkan ID
        $dosens = Dosen::findOrFail($id);
        $mahasiswas = Mahasiswa::all();
        return view('Konsul.Atur', compact('dosens', 'mahasiswas'));
    }

    public function edit($id)
    {
        // Temukan dosen berdasarkan ID
        $dosens = Dosen::findOrFail($id);
        $mahasiswas = Mahasiswa::all();
        return view('Konsul.Atur', compact('dosens', 'mahasiswas'));
    }

    public function store(Request $request, $id)
    {
        $dosen = Dosen::findOrFail($id);
        $mahasiswaIds = $request->mahasiswa_ids;

        foreach ($mahasiswaIds as $mahasiswaId) {
            // cek jika mahasiswa sudah terdaftar pada dosen pembimbing
            $existingDosen = DB::table('bimbingan')
                ->where('mahasiswa_id', $mahasiswaId)
                ->where('dosen_id', '!=', $id)
                ->exists();

            if ($existingDosen) {
                return redirect()->route('atur-bimbingan', ['id' => $id])
                    ->with('error', "Mahasiswa sudah memiliki dosen pembimbing.");
            }
        }

        // Tambah atau update relationships
        $dosen->mahasiswa()->syncWithoutDetaching($mahasiswaIds);
        
        return redirect()->route('atur-bimbingan', ['id' => $id])->with('success', 'Mahasiswa berhasil ditambahkan.');
    }
    

    public function update(Request $request, $id)
    {
        // Validasi request
        $request->validate([
            'mahasiswa_ids' => 'required|array',
            'mahasiswa_ids.*' => 'exists:mahasiswa,id'
        ]);

        // Temukan dosen berdasarkan ID
        $dosen = Dosen::findOrFail($id);
        
        // Sinkronisasi mahasiswa dengan dosen
        $dosen->mahasiswa()->sync($request->mahasiswa_ids);
        
        return redirect()->route('daftar-bimbingan')->with('success', 'Mahasiswa berhasil diperbarui.');
    }
    public function destroy($dosenId, $mahasiswaId)
{
    $dosen = Dosen::findOrFail($dosenId);

    // Pastikan relasi mahasiswa ada
    if ($dosen->mahasiswa()->where('mahasiswa_id', $mahasiswaId)->exists()) {
        $dosen->mahasiswa()->detach($mahasiswaId);

        return redirect()->route('atur-bimbingan', ['id' => $dosenId])->with('success', 'Mahasiswa berhasil dihapus dari bimbingan.');
    } else {
        return redirect()->route('atur-bimbingan', ['id' => $dosenId])->with('error', 'Mahasiswa tidak ditemukan di bimbingan.');
    }
}

}
