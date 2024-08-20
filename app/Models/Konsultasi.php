<?php

// app/Models/Konsultasi.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    use HasFactory;
    protected $table = 'konsultasi';
    protected $fillable = [
        'mahasiswa_id',
        'dosen_id',
        'semester',
        'kegiatan',
        'permasalahan',
        'solusi',
        'solusi_diberikan',
        'status_persetujuan',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class,'mahasiswa_id');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class,'dosen_id');
    }
    public function semester()
    {
        return $this->belongsTo(Semester::class,'semester_id');
    }
}

