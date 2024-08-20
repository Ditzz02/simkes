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
            $table->integer('nilai')->nullable()->after('semester');
        });
    }

    public function down()
    {
        Schema::table('krs', function (Blueprint $table) {
            $table->dropColumn('nilai');
        });
    }
};
