<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    Public function tampil()
    {
        $mahasiswa = Mahasiswa::all(); // Mengambil semua data mahasiswa
        return view('khs.daftar', compact('mahasiswa'));
    }
    
}
