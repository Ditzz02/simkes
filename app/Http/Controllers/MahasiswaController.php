<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = 10; // Jumlah item per halaman
        $page = $request->get('page', 1); // Ambil halaman saat ini dari permintaan, default ke 1
        $search = $request->input('search'); // Ambil query pencarian

        // Hitung offset
        $offset = ($page - 1) * $perPage; //

        // Ambil data mahasiswa dengan paginasi dan pencarian
        $mahasiswa = Mahasiswa::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                        ->orWhere('nim', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
        })->paginate($perPage);

        return view('Mahasiswa.Daftar', compact('mahasiswa', 'offset', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Mahasiswa.Tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|string|max:20|unique:mahasiswa',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:mahasiswa',
            'jenis_kelamin' => 'required|string|max:10',
            'jurusan' => 'required|string|max:100',
            'semester' => 'required|string|max:10',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'nomor_telepon' => 'nullable|string|max:15',
            'nama_orang_tua' => 'nullable|string|max:255',
            'nomor_telepon_orang_tua' => 'nullable|string|max:15',
            'angkatan' => 'required|string|max:10',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Simpan foto jika ada
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto_mahasiswa', 'public');
        }

        // Simpan data mahasiswa
        $mahasiswa = Mahasiswa::create([
            'nim' => $request->input('nim'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'jurusan' => $request->input('jurusan'),
            'prodi' => $request->input('prodi'),
            'semester' => $request->input('semester'),
            'tempat_lahir' => $request->input('tempat_lahir'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'alamat' => $request->input('alamat'),
            'nomor_telepon' => $request->input('nomor_telepon'),
            'nama_orang_tua' => $request->input('nama_orang_tua'),
            'nomor_telepon_orang_tua' => $request->input('nomor_telepon_orang_tua'),
            'angkatan' => $request->input('angkatan'),
            'foto' => $fotoPath,
        ]);

        // Tambahkan mahasiswa ke semester default
        $semesterIds = Semester::pluck('id')->toArray();
        $mahasiswa->semesters()->attach($semesterIds);

        Alert::success('Data Berhasil Ditambahkan');
        return redirect()->route('daftar_mahasiswa')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('Mahasiswa.Tampil', compact('mahasiswa'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id) {
        //dd($id);
        $mahasiswa = Mahasiswa::findOrFail($id);
        if ($mahasiswa) {
            return view('Mahasiswa.Edit',compact('mahasiswa'));
        } else {
            Alert::error('Mahasiswa tidak ditemukan');
            return redirect()->route('daftar_mahasiswa')->with('error', 'Mahasiswa tidak ditemukan');
            
        }
    }
    /**
     * Update the specified resource in storage.
     */

     public function update(Request $request, $id) {
        $request->validate([
            'nim' => 'required|string|max:20|unique:mahasiswa',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'jenis_kelamin' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
            'semester' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'nomor_telepon' => 'nullable|string|max:20',
            'nama_orang_tua' => 'nullable|string|max:255',
            'nomor_telepon_orang_tua' => 'nullable|string|max:20',
            'angkatan' => 'required|string|max:4',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        $mahasiswa = Mahasiswa::find($id);
    
        if (!$mahasiswa) {
            Alert::error('Data tidak terupdate');
            return redirect()->route('daftar_mahasiswa')->with('error', 'Mahasiswa not found');
        }
    
        // Update mahasiswa data
        $mahasiswa->nim = $request->nim;
        $mahasiswa->name = $request->name;
        $mahasiswa->email = $request->email;
        $mahasiswa->jenis_kelamin = $request->jenis_kelamin;
        $mahasiswa->jurusan = $request->jurusan;
        $mahasiswa->prodi = $request->prodi;
        $mahasiswa->semester = $request->semester;
        $mahasiswa->tempat_lahir = $request->tempat_lahir;
        $mahasiswa->tanggal_lahir = $request->tanggal_lahir;
        $mahasiswa->alamat = $request->alamat;
        $mahasiswa->nomor_telepon = $request->nomor_telepon;
        $mahasiswa->nama_orang_tua = $request->nama_orang_tua;
        $mahasiswa->nomor_telepon_orang_tua = $request->nomor_telepon_orang_tua;
        $mahasiswa->angkatan = $request->angkatan;
    
        // Handle photo upload
        if ($request->hasFile('foto')) {
            // Delete old photo if exists
            if ($mahasiswa->foto && Storage::exists('public/' . $mahasiswa->foto)) {
                Storage::delete('public/' . $mahasiswa->foto);
            }
            
            $file = $request->file('foto');
            $filePath = $file->store('foto_mahasiswa', 'public');
            $mahasiswa->foto = $filePath;
        }
    
        $mahasiswa->save();
    
        Alert::success('Data Berhasil Di Update');
        return redirect()->route('daftar_mahasiswa')->with('success', 'Mahasiswa updated successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Temukan mahasiswa berdasarkan ID
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json(['error' => 'Mahasiswa not found'], 404);
        }

        // Hapus file foto dari penyimpanan jika ada
        if ($mahasiswa->foto && Storage::exists('public/' . $mahasiswa->foto)) {
            Storage::delete('public/' . $mahasiswa->foto);
        }

        // Hapus data mahasiswa dari database
        $mahasiswa->delete();

        // Kirimkan response JSON sukses
        return response()->json(['success' => 'Mahasiswa deleted successfully']);
    }

    public function updateNilai(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $nilaiMataKuliah = $request->input('mata_kuliah');
        $totalSks = 0;
        $totalNilai = 0;

        foreach ($nilaiMataKuliah as $mataKuliahId => $nilai) {
            $mataKuliah = MataKuliah::find($mataKuliahId);

            if ($mataKuliah) {
                $sks = $mataKuliah->sks;
                $totalSks += $sks;
                $totalNilai += $nilai * $sks;

                // Update nilai pada tabel pivot
                $mahasiswa->mataKuliah()->updateExistingPivot($mataKuliahId, ['nilai' => $nilai]);
            }
        }

        // Hitung IPK baru
        $ipk = $totalSks > 0 ? round($totalNilai / $totalSks, 2) : 0;
        $mahasiswa->ipk = $ipk;
        $mahasiswa->save();

        return redirect()->back()->with('success', 'Data berhasil diperbarui!');
    }

}
