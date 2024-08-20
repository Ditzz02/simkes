<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSolusiDiberikanToKonsultasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('konsultasi', function (Blueprint $table) {
            $table->boolean('solusi_diberikan')->default(false);
            $table->boolean('status_persetujuan')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('konsultasi', function (Blueprint $table) {
            $table->dropColumn('solusi_diberikan');
        });
    }
}
