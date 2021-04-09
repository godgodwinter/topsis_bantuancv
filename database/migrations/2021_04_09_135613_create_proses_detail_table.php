<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProsesDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_proses_detail', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kriteria_id')->indeks();
            $table->string('nik')->indeks();
            $table->string('th_penerimaan_id')->indeks();
            $table->string('setting_range_id')->indeks();
            $table->string('bobot_sr')->indeks();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proses_detail');
    }
}
