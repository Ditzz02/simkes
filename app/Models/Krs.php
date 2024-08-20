<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Krs extends Model
{
    use HasFactory;

    // Nama tabel jika tidak sesuai dengan konvensi penamaan Laravel
    protected $table = 'krs';

    // Daftar kolom yang dapat diisi secara massal
    protected $fillable = [
        'mahasiswa_id',
        'matakuliah_id',
        'semester',
        'nilai',
    ];

    // Menentukan relasi dengan model Mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class,'mahasiswa_id');
    }

    // Menentukan relasi dengan model MataKuliah
    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'matakuliah_id');
    }
    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }
}
