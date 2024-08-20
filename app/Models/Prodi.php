<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;
    protected $table = 'prodi';
    protected $fillable = ['name'];

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class);
    }

    public function mataKuliah()
    {
        return $this->hasMany(MataKuliah::class);
    }
}

