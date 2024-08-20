<?php

namespace Database\Seeders;
use App\Models\User;
use Faker\Factory as Faker;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
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

        $faker = Faker::create('id_ID');

        for($i = 1; $i <= 20; $i++){
            $gender = $faker->randomElement(['Laki-laki', 'Perempuan']);
            $jurusan = $faker->randomElement(['Teknik Informatika', 'Sistem Informasi', 'Teknik Komputer']);
            $semester = $faker->numberBetween(1, 8);
            $foto = $faker->imageUrl(640, 480, 'people', true, 'Faker');
            $status_keaktifan = $faker->randomElement(['aktif', 'tidak aktif']);
            $angkatan = $faker->year($max = 'now');
            $ipk = $faker->randomFloat(2, 0, 4);

            DB::table('mahasiswa')->insert([
                'nim' => $faker->numerify('2002####'),
                'name' => $faker->name,
                'level' => 'Mahasiswa',
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('12345'),
                'jurusan' => $jurusan,
                'semester' => $semester,
                'jenis_kelamin' => $gender,
                'foto' => $foto,
                'tanggal_lahir' => $faker->date('Y-m-d', '2000-12-31'),
                'alamat' => $faker->address,
                'nomor_telepon' => $faker->phoneNumber,
                'nama_orang_tua' => $faker->name,
                'nomor_telepon_orang_tua' => $faker->phoneNumber,
                'status_keaktifan' => $status_keaktifan,
                'angkatan' => $angkatan,
                'ipk' => $ipk,
                'email_verified_at' => $faker->dateTimeThisDecade($max = 'now'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 20; $i++) {
            $gender = $faker->randomElement(['Laki-laki', 'Perempuan']);
            $jurusan = $faker->randomElement(['Teknik Informatika', 'Sistem Informasi', 'Teknik Komputer']);
            $jabatan = $faker->randomElement(['Lektor', 'Asisten Ahli', 'Profesor']);
            $foto = $faker->imageUrl(640, 480, 'people', true, 'Faker');
            $status_kepegawaian = $faker->randomElement(['Tetap', 'Kontrak']);

            DB::table('dosen')->insert([
                'nidn' => $faker->numerify('1980####'),
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('12345'),
                'jenis_kelamin' => $gender,
                'foto' => $foto,
                'tanggal_lahir' => $faker->date('Y-m-d', '1980-12-31'),
                'alamat' => $faker->address,
                'nomor_telepon' => $faker->phoneNumber,
                'jurusan' => $jurusan,
                'jabatan' => $jabatan,
                'pendidikan_terakhir' => $faker->randomElement(['S1', 'S2', 'S3']),
                'status_kepegawaian' => $status_kepegawaian,
                'email_verified_at' => $faker->dateTimeThisDecade($max = 'now'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        
    		DB::table('matakuliah')->insert([
                'kode_mk' => 'MK-001',
    			'nama_mk' => 'PEMOGRAMAN WEB',
                'sks' => '2'
    		]);

            DB::table('matakuliah')->insert([
                'kode_mk' => 'MK-002',
    			'nama_mk' => 'PANCASILA',
                'sks' => '3'
    		]);

            DB::table('matakuliah')->insert([
                'kode_mk' => 'MK-003',
    			'nama_mk' => 'ALJABAR LINEAR',
                'sks' => '2'
    		]);

            DB::table('matakuliah')->insert([
                'kode_mk' => 'MK-004',
    			'nama_mk' => 'REKAYASA PERANGKAT LUNAK',
                'sks' => '1'
    		]);
        
    
    /*
        User::factory()->create([
            'name' => 'Fernandito Kumaunang',
            'email' => 'admin@gmail.com',
            'Password' => bcrypt(12345),
        ]);*/
    }
}
