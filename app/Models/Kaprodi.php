<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Kaprodi extends Authenticatable
{
    use Notifiable;
    protected $table = 'kaprodi';
    protected $fillable = [
        'name', 'email', 'password','jurusan','prodi','jenis_kelamin'
    ];
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id', 'id');
    }

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}