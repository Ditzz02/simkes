<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Konsultasi;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KaprodiController extends Controller
{
    public function index()
    {
        $konsultasi = Konsultasi::with(['mahasiswa', 'dosen'])->get();
        return view('Kaprodi.index', compact('konsultasi'));
    }

    public function approve($id)
    {
        $konsultasi = Konsultasi::findOrFail($id);
        $konsultasi->status_persetujuan = true;
        $konsultasi->save();

        return redirect()->route('kaprodi-index')->with('success', 'Konsultasi telah disetujui.');
    }

    public function show($id)
    {
        $konsultasi = Konsultasi::findOrFail($id);
        return view('Kaprodi.show', compact('konsultasi'));
    }

    public function utama()
    {

        
        // Hitung jumlah mahasiswa, dosen, dan mata kuliah
        $jumlahMahasiswa = Mahasiswa::count();
        $jumlahDosen = Dosen::count();
        $jumlahMataKuliah = MataKuliah::count();

        return view('Halaman.Beranda', compact('jumlahMahasiswa', 'jumlahDosen', 'jumlahMataKuliah'));
    }
    
}
