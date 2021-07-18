<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRwdusunOnDatawargatable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_warga', function($table) {
            $table->string('dusun_id')->nullable();
            $table->string('dusun_nama')->nullable();
            $table->string('rw_id')->nullable();
            $table->string('rw_nama')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
