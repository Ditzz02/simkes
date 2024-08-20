<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bimbingan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dosen_id');
            $table->unsignedBigInteger('mahasiswa_id');
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('dosen_id')->references('id')->on('dosen')->onDelete('cascade');
            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswa')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bimbingan');
    }
};