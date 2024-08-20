<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Kaprodi;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LoginController extends Controller
{
    public function postlogin(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
    
        // Periksa apakah email ada di salah satu dari model
        $mahasiswa = Mahasiswa::where('email', $credentials['email'])->first();
        $user = User::where('email', $credentials['email'])->first();
        $dosen = Dosen::where('email', $credentials['email'])->first();
        $kaprodi = Kaprodi::where('email', $credentials['email'])->first();
    
        // Coba login untuk mahasiswa
        if ($mahasiswa && Auth::guard('mahasiswa')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/beranda');
        }
        // Coba login untuk user umum
        elseif ($user && Auth::guard('user')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/beranda');
        }
        // Coba login untuk dosen
        elseif ($dosen && Auth::guard('dosen')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/beranda');
        }
        // Coba login untuk kaprodi
        elseif ($kaprodi && Auth::guard('kaprodi')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/beranda');
        }
    
        // Jika email ditemukan tetapi password salah
        if ($mahasiswa || $user || $dosen || $kaprodi) {
            return back()->withErrors([
                'password' => 'Password yang dimasukkan salah',
            ])->onlyInput('email');
        }
        
        // Jika email tidak ditemukan
        return back()->withErrors([
            'email' => 'Email ini tidak terdaftar',
        ])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
