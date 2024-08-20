<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        
        // Hitung jumlah mahasiswa, dosen, dan mata kuliah
        $jumlahMahasiswa = Mahasiswa::count();
        $jumlahDosen = Dosen::count();
        $jumlahMataKuliah = MataKuliah::count();

        return view('Halaman.Beranda', compact('jumlahMahasiswa', 'jumlahDosen', 'jumlahMataKuliah'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
