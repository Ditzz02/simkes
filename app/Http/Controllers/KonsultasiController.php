<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use App\Models\Konsultasi;
use Endroid\QrCode\QrCode;
use Illuminate\Http\Request;
use Endroid\QrCode\Logo\Logo;
use Illuminate\Routing\Controller;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Notifications\SolusiNotification;

class KonsultasiController extends Controller
{
    public function index()
    {
        if (Auth::guard('mahasiswa')->check()) {
            $mahasiswa = Auth::guard('mahasiswa')->user();
            
            // Pastikan ini mengembalikan koleksi
            $semesters = $mahasiswa->semesters; 
    
            $konsultasi = Konsultasi::where('mahasiswa_id', $mahasiswa->id)
                                    ->with('dosen')
                                    ->orderBy('semester')
                                    ->get();
        } elseif (Auth::guard('dosen')->check()) {
            $dosen = Auth::guard('dosen')->user();
            $konsultasi = Konsultasi::where('dosen_id', $dosen->id)
                                    ->with('mahasiswa')
                                    ->orderBy('semester')
                                    ->get();
            $semesters = collect(); // Jika dosen, tidak perlu ada semester
        } else {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }
    
        return view('konsultasi.index', compact('konsultasi', 'semesters'));
    }
    


    public function create()
    {
        $mahasiswa = Auth::guard('mahasiswa')->user();
        $hasDosenPembimbing = $mahasiswa->dosen !== null;

        // Ambil data semester dari database hanya jika mahasiswa memiliki dosen pembimbing
        $semesters = $hasDosenPembimbing ? Semester::all() : collect();

        return view('konsultasi.create', compact('hasDosenPembimbing', 'semesters'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'semester' => 'required|integer',
            'kegiatan' => 'required|array',
            'kegiatan.*' => 'required|string|max:255',
            'permasalahan' => 'required|array',
            'permasalahan.*' => 'required|string',
        ]);

        $mahasiswa = Auth::guard('mahasiswa')->user();
        $dosen = $mahasiswa->dosen()->first();
        

        if ($dosen) {
            // Periksa konsultasi untuk semester yang dipilih
            $jumlahKonsultasi = Konsultasi::where('mahasiswa_id', $mahasiswa->id)
                                        ->where('semester', $request->semester)
                                        ->count();

            if ($jumlahKonsultasi >= 4) {
                return redirect()->route('konsul-create')->with('error', 'batas konsultasi hanya sebanyak 4 kali untuk semester ini.');
            }

            foreach ($request->kegiatan as $index => $kegiatan) {
                if ($jumlahKonsultasi >= 4) {
                    return redirect()->route('konsul-create')->with('error', 'Anda sudah membuat konsultasi sebanyak 4 kali untuk semester ini.');
                }

                $konsultasi = Konsultasi::create([
                    'mahasiswa_id' => $mahasiswa->id,
                    'dosen_id' => $dosen->id,
                    'semester' => $request->semester, // Simpan informasi semester
                    'kegiatan' => $kegiatan,
                    'permasalahan' => $request->permasalahan[$index],
                ]);

                // Logika pembuatan QR Code...
                $qrCode = new QrCode(route('konsul-show', $konsultasi->id));
                $qrCode->setSize(300);

                $writer = new PngWriter();
                $qrCodePath = 'qrcodes/' . $konsultasi->id . '.png';
                $logoPath = public_path('NiceAdmin/assets/img/Logo_Polimdo.png');
                $logo = Logo::create($logoPath)
                            ->setResizeToWidth(50)
                            ->setPunchoutBackground(true);

                $result = $writer->write($qrCode, $logo);
                Storage::disk('public')->put($qrCodePath, $result->getString());

                $konsultasi->qr_code = $qrCodePath;
                $konsultasi->save();

                $jumlahKonsultasi++;
            }

            return redirect()->route('konsul-index')->with('success', 'Konsultasi berhasil dibuat.');
        } else {
            return redirect()->route('konsul-create')->with('error', 'Dosen pembimbing tidak ditemukan.');
        }
    }

    public function show($id)
    {
        $konsultasi = Konsultasi::findOrFail($id);
        return view('konsultasi.show', compact('konsultasi'));
    }

    public function respond(Request $request, $id)
    {
        $request->validate([
            'solusi' => 'required|string',
        ]);

        $konsultasi = Konsultasi::findOrFail($id);
        $konsultasi->update([
            'solusi' => $request->solusi,
            'solusi_diberikan' => true,
        ]);

        $mahasiswa = $konsultasi->mahasiswa;
        $mahasiswa->notify(new SolusiNotification($konsultasi));

        return redirect()->route('konsul-index')->with('success', 'Solusi berhasil ditambahkan.');
    }

    public function approve($id)
    {
        $konsultasi = Konsultasi::findOrFail($id);

        if ($konsultasi->solusi_diberikan) {
            $konsultasi->status_persetujuan = true;
            $konsultasi->save();

            return redirect()->route('konsul-index')->with('success', 'Konsultasi berhasil disetujui.');
        } else {
            return redirect()->route('konsul-index')->with('error', 'Solusi belum diberikan oleh dosen.');
        }
    }
    public function destroy($id)
{
    $konsultasi = Konsultasi::findOrFail($id);

    // Pastikan hanya konsultasi yang belum diberikan solusi yang dapat dihapus
    if (!$konsultasi->solusi_diberikan) {
        $konsultasi->delete();

        return redirect()->route('konsul-index')->with('success', 'Konsultasi berhasil dihapus.');
    }

    return redirect()->route('konsul-index')->with('error', 'Konsultasi tidak dapat dihapus karena solusi sudah diberikan.');
}
}
