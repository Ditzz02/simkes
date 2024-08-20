<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IPS extends Model
{
    use HasFactory;

    protected $table = 'ips';

    protected $fillable = [
        'mahasiswa_id',
        'semester',
        'ips',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }
}
