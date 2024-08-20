<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class MataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $perPage = 10;
    $page = $request->get('page', 1);
    $search = $request->input('search');
    $sort = $request->input('sort', 'semester'); // Default sort by 'semester'
    $order = $request->input('order', 'asc'); // Default sort order 'ascending'
    $prodis = Prodi::all();

    $offset = ($page - 1) * $perPage;

    $mata_kuliah = MataKuliah::when($search, function ($query, $search) {
        return $query->where('kode_mk', 'like', "%{$search}%")
                     ->orWhere('nama_mk', 'like', "%{$search}%")
                     ->orWhere('sks', 'like', "%{$search}%")
                     ->orWhere('semester', 'like', "%{$search}%");
    })
    ->orderBy($sort, $order) // Apply sorting
    ->paginate($perPage);

    return view('Mk.Daftar', compact('mata_kuliah', 'offset', 'search', 'sort', 'order','prodis'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prodis = \App\Models\Prodi::all(); // Ambil semua data Prodi
        return view('Mk.Tambah', compact('prodis'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'kode_mk' => 'required|string|max:10|unique:matakuliah,kode_mk',
                'nama_mk' => 'required|string|max:255|unique:matakuliah,nama_mk',
                'semester' => 'required|integer',
                'sks' => 'required|integer',
                'prodi_id' => 'required|exists:prodi,id',
            ]);

            // Create a new MataKuliah entry
            MataKuliah::create($request->all());

            // Return success message
            if ($request->ajax()) {
                return response()->json(['success' => true]);
            } else {
                return redirect()->route('daftar_mk')->with('success', 'Mata kuliah ditambahkan');
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Return validation errors
            if ($request->ajax()) {
                $errors = $e->validator->errors();
                return response()->json(['success' => false, 'errors' => $errors->toArray()]);
            } else {
                return redirect()->back()->withErrors($e->validator)->withInput();
            }
        } catch (\Exception $e) {
            // Return error message
            if ($request->ajax()) {
                return response()->json(['success' => false, 'error' => 'Terjadi kesalahan saat menyimpan data']);
            } else {
                return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data');
            }
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $mata_kuliah = MataKuliah::findOrFail($id);
        return view('Mk.Edit', compact('mata_kuliah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_mk' => 'required|string|max:10',
            'nama_mk' => 'required|string|max:255',
            'semester' => 'required|integer',
            'sks' => 'required|integer',
            'prodi_id' => 'required|exists:prodi,id'
            
        ]);

        $mata_kuliah = MataKuliah::find($id);

        if (!$mata_kuliah) {
            Alert::error('Data tidak terupdate');
            return redirect()->route('daftar_mk')->with('error', 'Mata Kuliah tidak ditemukan');
        }

        $mata_kuliah->update($request->all());
        Alert::success('Data Berhasil Di Update');
        return redirect()->route('daftar_mk')->with('success', 'Mata Kuliah updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mata_kuliah = MataKuliah::find($id);

        if (!$mata_kuliah) {
            return response()->json(['error' => 'Mata Kuliah not found'], 404);
        }

        $mata_kuliah->delete();

        return response()->json(['success' => 'Mata Kuliah deleted successfully']);
    }
}
