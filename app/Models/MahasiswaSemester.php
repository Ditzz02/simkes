<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaSemester extends Model
{
    use HasFactory;
    protected $table = 'mahasiswa_semester'; // Nama tabel

    protected $fillable = [
        'mahasiswa_id',
        'semester_id',
    ];
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }
}
