<?php

namespace Database\Seeders;

use App\Models\Semester;
use App\Models\Mahasiswa;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MahasiswaSemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Misal menghubungkan mahasiswa dengan ID 1 ke semua semester
        $mahasiswa = Mahasiswa::find(3);

        if ($mahasiswa) {
            $semesters = Semester::pluck('id')->all(); // Ambil semua ID semester
            $mahasiswa->semesters()->sync($semesters); // Hubungkan ke semua semester
        }

        // Tambahkan logika lain sesuai kebutuhan
    }
}
