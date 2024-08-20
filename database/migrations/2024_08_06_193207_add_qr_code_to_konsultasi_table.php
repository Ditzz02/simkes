<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQrCodeToKonsultasiTable extends Migration
{
    public function up()
    {
        Schema::table('konsultasi', function (Blueprint $table) {
            $table->string('qr_code')->nullable();
        });
    }

    public function down()
    {
        Schema::table('konsultasi', function (Blueprint $table) {
            $table->dropColumn('qr_code');
        });
    }
};
