<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('krs', function (Blueprint $table) {
        //$table->unsignedBigInteger('semester_id')->nullable()->after('matakuliah_id');

        // Jika Anda ingin memastikan data integrity
        //$table->foreign('semester_id')->references('id')->on('semesters')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('krs', function (Blueprint $table) {
            //
        });
    }
};
