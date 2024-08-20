<?php

// database/migrations/xxxx_xx_xx_create_konsultasi_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('konsultasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mahasiswa_id');
            $table->unsignedBigInteger('dosen_id')->nullable();
            $table->text('kegiatan');
            $table->text('permasalahan');
            $table->text('solusi')->nullable();
            $table->timestamps();

            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('dosen_id')->references('id')->on('dosen')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('konsultasi');
    }
};
