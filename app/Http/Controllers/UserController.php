<?php

namespace App\Http\Controllers;

use App\Models\Bimbingan;
use App\Models\Krs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Show the profile for the authenticated user.
     */
    public function showProfile(Request $request)
    {
        $user = Auth::user();
        $khs = [];
        $dosen = [];
        $mahasiswa = [];
        $selectedSemester = $request->input('semester');
        $semesters = [];  // Deklarasikan variabel di sini dengan nilai default

        if ($user->level === 'Mahasiswa') {
            // Jika semester tidak dipilih, gunakan semester terakhir sebagai default
            if (!$selectedSemester) {
                $selectedSemester = Krs::where('mahasiswa_id', $user->id)
                    ->orderBy('semester', 'desc')
                    ->pluck('semester')
                    ->first();
            }

            // Ambil data KHS berdasarkan semester yang dipilih
            $khs = Krs::with('mataKuliah')
                ->where('mahasiswa_id', $user->id)
                ->where('semester', $selectedSemester)
                ->get();
            
            // Ambil daftar semester yang telah ditempuh
            $semesters = Krs::where('mahasiswa_id', $user->id)
                ->orderBy('semester', 'asc')
                ->pluck('semester')
                ->unique();
            
            // Ambil dosen pembimbing
            $dosen = Bimbingan::with('dosen')->where('mahasiswa_id', $user->id)->first();
            
        } elseif ($user->level === 'Dosen') {
            $mahasiswa = $user->mahasiswa;  // Ambil mahasiswa bimbingan
        }

        function nilaiHuruf($nilai)
        {
            if ($nilai >= 85) return 'A';
            else if ($nilai >= 70) return 'B';
            else if ($nilai >= 55) return 'C';
            else if ($nilai >= 40) return 'D';
            else return 'E';
        }

        // Hitung IPS
        $totalSks = 0;
        $totalNilai = 0;

        if ($user->level === 'Mahasiswa' && $khs->isNotEmpty()) {
            foreach ($khs as $item) {
                $totalSks += $item->mataKuliah->sks;
                $totalNilai += $item->mataKuliah->sks * $this->nilaiAngka($item->nilai);
            }
        }

        $ips = $totalSks ? round($totalNilai / $totalSks, 2) : 'N/A';

        return view('Pengguna.Profile', compact('user', 'khs', 'mahasiswa', 'dosen', 'selectedSemester', 'semesters', 'ips'));
    }


   // Fungsi untuk mengonversi nilai huruf ke angka
    private function nilaiAngka($grade)
    {
        switch($grade) {
            case 'A':
                return 4.0;
            case 'B':
                return 3.0;
            case 'C':
                return 2.0;
            case 'D':
                return 1.0;
            case 'E':
                return 0.0;
            default:
                return 0.0;
        }
    }


    public function editProfil(Request $request)
    {
        $user = Auth::user();
        
        // Validasi input
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:3',
            'jenis_kelamin' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        // Update user information
        $user->name = $data['name'];
        $user->email = $data['email'];
        if ($user->level === 'Mahasiswa'){
            $user->jenis_kelamin = $data['jenis_kelamin'];
        }
        
        if ($data['password']) {
            $user->password = Hash::make($data['password']);
        }
        $user->name = $request->name;
        $user->email = $request->email;
    
        // Update foto
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto && Storage::exists('public/' . $user->foto)) {
                Storage::delete('public/' . $user->foto);
            }
    
            // Simpan foto baru
            $file = $request->file('foto');
            $path = $file->store('profile_pictures', 'public');
            $user->foto = $path;
        }
        
        $user->save();
        
        Alert::success('Data Berhasil Diupdate');
        return redirect()->route('profil')->with('success', 'Profil berhasil diperbarui.');
    }
    
}


