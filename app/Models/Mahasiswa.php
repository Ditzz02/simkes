<?php
namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Mahasiswa extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table= 'mahasiswa';
    protected $guard = 'mahasiswa';
    protected $fillable = [
        'nim',
        'name',
        'level',
        'email',
        'password',
        'jurusan',
        'prodi',
        'semester',
        'jenis_kelamin',
        'foto',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'nomor_telepon',
        'nama_orang_tua',
        'nomor_telepon_orang_tua',
        'status_keaktifan',
        'angkatan',
        'ipk',
    ];

    public function semesters()
    {
        return $this->belongsToMany(Semester::class, 'mahasiswa_semester');
    }


    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }

    public function mataKuliah()
    {
        return $this->belongsToMany(MataKuliah::class, 'Krs')
                    ->withPivot('nilai')
                    ->withTimestamps();
    }
    
    public function dosen()
    {
        return $this->belongsToMany(Dosen::class, 'bimbingan', 'mahasiswa_id', 'dosen_id');
    }

    public function krs()
    {
        return $this->hasMany(Krs::class); 
    }

    public function bimbingan()
    {
        return $this->hasMany(Bimbingan::class);
    }

    public function calculateIpk()
    {
        $totalSks = 0;
        $totalNilai = 0;

        foreach ($this->mataKuliah as $mk) {
            $nilai = $mk->pivot->nilai;
            $sks = $mk->sks;

            $totalSks += $sks;
            $totalNilai += $nilai * $sks;
        }

        return $totalSks > 0 ? round($totalNilai / $totalSks, 2) : 0;
    }
    public function ips()
    {
        return $this->hasMany(Ips::class);
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'tanggal_lahir' => 'date',
    ];
}
