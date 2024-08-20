<?php

// database/migrations/xxxx_xx_xx_xxxxxx_add_prodi_and_tempat_lahir_to_mahasiswa_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProdiAndTempatLahirToMahasiswaTable extends Migration
{
    public function up()
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->string('prodi')->nullable(); // Menambahkan kolom 'prodi'
            $table->string('tempat_lahir')->nullable(); // Menambahkan kolom 'tempat_lahir'
        });
    }

    public function down()
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->dropColumn('prodi'); // Menghapus kolom 'prodi' jika migrasi dibatalkan
            $table->dropColumn('tempat_lahir'); // Menghapus kolom 'tempat_lahir' jika migrasi dibatalkan
        });
    }
}
