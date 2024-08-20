<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Semester;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Semester::create([
            'name' => 'Ganjil 2024',
            'year' => 2024,
            'term' => 'ganjil',
        ]);

        Semester::create([
            'name' => 'Genap 2024',
            'year' => 2024,
            'term' => 'genap',
        ]);

        // Tambahkan semester lain sesuai kebutuhan
    }
}
