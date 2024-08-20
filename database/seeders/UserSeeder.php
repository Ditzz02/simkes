<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        DB::table('users')->insert([
        	'name' => 'Fernandito Kumaunang',
        	'level' => 'Admin',
        	'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
        	'password' => bcrypt(12345),
            'foto'=> 'public\img\profil.jpg',
            'remember_token' => Str::random(),
            
        ]);
    }
}
