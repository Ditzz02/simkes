<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;

    protected $table = 'matakuliah';

    protected $fillable = [
        'kode_mk',
        'nama_mk',
        'semester',
        'sks',
        'prodi_id',
    ];
    
    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }

    public function mahasiswa()
    {
        return $this->belongsToMany(Mahasiswa::class, 'Krs')->withPivot('nilai')->withTimestamps();
    }

    public function krs()
    {
        return $this->hasMany(Krs::class);
    }
    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }
}
