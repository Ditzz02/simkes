<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSemesterIdToKonsultasiTable extends Migration
{
    public function up()
    {
        Schema::table('konsultasi', function (Blueprint $table) {
            $table->unsignedBigInteger('semester_id')->nullable()->after('mahasiswa_id');

            // Jika Anda ingin mengatur foreign key
            $table->foreign('semester_id')->references('id')->on('semesters')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('konsultasi', function (Blueprint $table) {
            $table->dropForeign(['semester_id']);
            $table->dropColumn('semester_id');
        });
    }
}
