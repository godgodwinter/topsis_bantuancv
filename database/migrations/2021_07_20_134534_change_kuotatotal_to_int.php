<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeKuotatotalToInt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kuota_rw', function (Blueprint $table) {
            $table->bigInteger('total')->charset(null)->collation(null)->change();
        });
        Schema::table('kuota_dusun', function (Blueprint $table) {
            $table->bigInteger('total')->charset(null)->collation(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('int', function (Blueprint $table) {
            //
        });
    }
}
