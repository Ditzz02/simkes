<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dosen', function (Blueprint $table) {
            $table->id();
            $table->string('nidn')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password')->default(bcrypt('12345'));
            $table->string('jenis_kelamin');
            $table->string('foto')->nullable();
            $table->string('alamat');
            $table->string('nomor_telepon')->nullable();
            $table->string('jurusan');
            $table->string('jabatan');
            $table->date('tanggal_lahir');
            $table->string('pendidikan_terakhir');
            $table->string('status_kepegawaian');
            $table->timestamps();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosen');
    }
};
