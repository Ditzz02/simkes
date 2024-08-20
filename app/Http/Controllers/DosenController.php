<?php
namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = 10;
        $page = $request->get('page', 1);
        $search = $request->input('search');

        $offset = ($page - 1) * $perPage;

        $dosen = Dosen::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                        ->orWhere('nidn', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
        })->paginate($perPage);

        return view('Dosen.Daftar', compact('dosen', 'offset', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Dosen.Tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nidn' => 'required|string|max:20|unique:dosen',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:dosen',
            'jenis_kelamin' => 'required|string|max:10',
            'jurusan' => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'nomor_telepon' => 'nullable|string|max:15',
            'pendidikan_terakhir' => 'required|string|max:100',
            'status_kepegawaian' => 'nullable|string|max:50',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto_dosen','public');
        }

        Dosen::create([
            'nidn' => $request->input('nidn'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt('12345'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'jurusan' => $request->input('jurusan'),
            'jabatan' => $request->input('jabatan'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'alamat' => $request->input('alamat'),
            'nomor_telepon' => $request->input('nomor_telepon'),
            'pendidikan_terakhir' => $request->input('pendidikan_terakhir'),
            'status_kepegawaian' => $request->input('status_kepegawaian'),
            'foto' => $fotoPath,
            
        ]);

        Alert::success('Data Berhasil Ditambahkan');
        return redirect()->route('daftar_dosen')->with('success', 'Dosen berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $dosen = Dosen::findOrFail($id);
        return view('Dosen.Edit', compact('dosen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nidn' => 'required|string|max:20',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'jenis_kelamin' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'nomor_telepon' => 'nullable|string|max:20',
            'pendidikan_terakhir' => 'required|string|max:255',
            'status_kepegawaian' => 'required|string|max:50',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $dosen = Dosen::find($id);

        if (!$dosen) {
            Alert::error('Data tidak terupdate');
            return redirect()->route('daftar_dosen')->with('error', 'Dosen tidak ditemukan');
        }

        $dosen->nidn = $request->nidn;
        $dosen->name = $request->name;
        $dosen->email = $request->email;
        $dosen->jenis_kelamin = $request->jenis_kelamin;
        $dosen->jurusan = $request->jurusan;
        $dosen->jabatan = $request->jabatan;
        $dosen->tanggal_lahir = $request->tanggal_lahir;
        $dosen->alamat = $request->alamat;
        $dosen->nomor_telepon = $request->nomor_telepon;
        $dosen->pendidikan_terakhir = $request->pendidikan_terakhir;
        $dosen->status_kepegawaian = $request->status_kepegawaian;

        //cek foto dan update jika tesimpan kemudian hapus foto sebelumnya
        if ($request->hasFile('foto')) {
            if ($dosen->foto && Storage::exists('public/' . $dosen->foto)) {
                Storage::delete('public/' . $dosen->foto);
            }

            $file = $request->file('foto');
            $filePath = $file->store('foto_dosen', 'public');
            $dosen->foto = $filePath;
        }

        $dosen->save();

        Alert::success('Data Berhasil Di Update');
        return redirect()->route('daftar_dosen')->with('success', 'Dosen updated berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dosen = Dosen::find($id);

        if (!$dosen) {
            return response()->json(['error' => 'Dosen tidak ditemukan'], 404);
        }

        if ($dosen->foto && Storage::exists('public/' . $dosen->foto)) {
            Storage::delete('public/' . $dosen->foto);
        }

        $dosen->delete();

        return response()->json(['success' => 'Dosen berhasil dihapus']);
    }
}
