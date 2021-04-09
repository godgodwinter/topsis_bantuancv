<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingRangeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_range', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kriteria_id')->index();
            $table->string('tanda')->nullable();
            $table->string('nilai1')->nullable();
            $table->string('nilai2')->nullable();
            $table->string('bobot')->nullable();
            $table->string('tipe')->nullable();
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
        Schema::dropIfExists('setting_range');
    }
}
