<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterVersionsAddFilename extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('versions', function (Blueprint $table) {
            $table->string('filename_on_system', 255)->after('version');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('versions', function (Blueprint $table) {
            $table->dropColumn('filename_on_system');
        });
    }
}
