<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bimbingan extends Model
{
    protected $table = 'bimbingan'; // Nama tabel

    protected $fillable = [
        'dosen_id',
        'mahasiswa_id',
    ];

    // Relasi ke model Dosen
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }

    // Relasi ke model Mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }
}
