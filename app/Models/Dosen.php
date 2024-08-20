<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;
//use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Dosen extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $table = 'dosen';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nidn',
        'name',
        'email',
        'password',
        'jenis_kelamin',
        'foto',
        'alamat',
        'nomor_telepon',
        'jurusan',
        'jabatan',
        'tanggal_lahir',
        'pendidikan_terakhir',
        'status_kepegawaian',
    ];

    public function mahasiswa()
    {
        // Pastikan nama tabel pivot sesuai
        return $this->belongsToMany(Mahasiswa::class, 'bimbingan', 'dosen_id', 'mahasiswa_id');
    }

    public function bimbingan()
    {
        return $this->hasMany(Bimbingan::class, 'dosen_id');
    }

    public $incrementing = true;
    protected $keyType = 'int';

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
