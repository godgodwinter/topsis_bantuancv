<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKuotaDusunAndKuotaRwTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kuota_dusun', function (Blueprint $table) {
            $table->id();
            $table->string('th_penerimaan_id')->nullable();
            $table->string('dusun_id')->nullable();
            $table->string('total')->nullable();
            $table->timestamps();
        });

        Schema::create('kuota_rw', function (Blueprint $table) {
            $table->id();
            $table->string('th_penerimaan_id')->nullable();
            $table->string('dusun_id')->nullable();
            $table->string('rw_id')->nullable();
            $table->string('total')->nullable();
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
        Schema::dropIfExists('kuota_dusun_and_kuota_rw');
    }
}
