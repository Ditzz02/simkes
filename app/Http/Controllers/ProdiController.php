<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    // Menampilkan daftar Prodi
    public function index()
    {
        $prodis = Prodi::all();
        return view('prodi.index', compact('prodis'));
    }

    // Menampilkan formulir pembuatan Prodi
    public function create()
    {
        return view('prodi.create');
    }

    // Menyimpan Prodi baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Prodi::create($request->all());

        return redirect()->route('prodi')->with('success', 'Prodi berhasil ditambahkan.');
    }

    // Menampilkan detail Prodi berdasarkan ID
    public function show($id)
    {
        $prodi = Prodi::findOrFail($id); // Mengambil data berdasarkan ID
        return view('prodi.show', compact('prodi'));
    }

    // Menampilkan formulir edit Prodi berdasarkan ID
    public function edit($id)
    {
        $prodi = Prodi::findOrFail($id); // Mengambil data berdasarkan ID
        return view('prodi.edit', compact('prodi'));
    }

    // Memperbarui Prodi di database berdasarkan ID
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $prodi = Prodi::findOrFail($id); // Mengambil data berdasarkan ID
        $prodi->update($request->all());

        return redirect()->route('prodi')->with('success', 'Prodi berhasil diperbarui.');
    }

    // Menghapus Prodi dari database berdasarkan ID
    public function destroy($id)
    {
        $prodi = Prodi::findOrFail($id); // Mengambil data berdasarkan ID
        $prodi->delete();

        return redirect()->route('prodi')->with('success', 'Prodi berhasil dihapus.');
    }
}
