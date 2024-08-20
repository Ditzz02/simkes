<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->string('nim')->unique();
            $table->string('name');
            $table->string('level')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->default(bcrypt('12345'));
            $table->string('jurusan')->nullable();
            $table->string('semester')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('foto')->nullable();
            $table->date('tanggal_lahir')->nullable(); // Tambahkan kolom tanggal lahir
            $table->string('alamat')->nullable(); // Tambahkan kolom alamat
            $table->string('nomor_telepon')->nullable(); // Tambahkan kolom nomor telepon
            $table->string('nama_orang_tua')->nullable(); // Tambahkan kolom nama orang tua/wali
            $table->string('nomor_telepon_orang_tua')->nullable(); // Tambahkan kolom nomor telepon orang tua/wali
            $table->string('status_keaktifan')->default('aktif'); // Tambahkan kolom status keaktifan
            $table->string('angkatan')->nullable(); // Tambahkan kolom angkatan
            $table->decimal('ipk', 3, 2)->nullable(); // Tambahkan kolom IPK
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Balikkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
