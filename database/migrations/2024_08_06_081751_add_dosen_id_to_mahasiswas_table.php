<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDosenIdToMahasiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            // Tambahkan kolom dosen_id
            $table->unsignedBigInteger('dosen_id')->nullable()->after('id'); // letakkan setelah kolom 'id'

            // Tambahkan foreign key constraint
            $table->foreign('dosen_id')->references('id')->on('dosen')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            // Hapus foreign key constraint
            $table->dropForeign(['dosen_id']);

            // Hapus kolom dosen_id
            $table->dropColumn('dosen_id');
        });
    }
};

