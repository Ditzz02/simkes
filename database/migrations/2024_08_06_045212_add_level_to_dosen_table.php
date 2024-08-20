<?php

// database/migrations/xxxx_xx_xx_xxxxxx_add_level_to_dosen_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLevelToDosenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dosen', function (Blueprint $table) {
            $table->string('level')->default('Dosen'); // Menambahkan kolom level
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dosen', function (Blueprint $table) {
            $table->dropColumn('level'); // Menghapus kolom level jika rollback
        });
    }
};

