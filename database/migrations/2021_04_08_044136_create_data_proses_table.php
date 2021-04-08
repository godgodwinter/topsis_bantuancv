<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataProsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_proses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kriteria_id')->indeks();
            // $table->foreign('kriteria_id')
            //         ->references('id')
            //         ->on('kriteria')
            //         ->onDelete('cascade ')
            //         ->onUpdate('cascade');
            $table->string('nik')->indeks();
            // $table->foreign('nik')
            //                 ->references('nik')
            //                 ->on('data_warga')
            //                 ->onDelete('cascade ')
            //                 ->onUpdate('cascade');
            $table->string('th_penerimaan_id')->indeks();
            // $table->foreign('th_penerimaan_id')
            //                                 ->references('id')
            //                                 ->on('th_penerimaan')
            //                                 ->onDelete('cascade ')
            //                                 ->onUpdate('cascade');

            $table->string('nilai')->nullable();
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
        Schema::dropIfExists('data_proses');
    }
}
