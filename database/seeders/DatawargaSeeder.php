<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class DatawargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create('id_ID');
        for($i = 1; $i <= 22; $i++){
            // insert data ke table products menggunakan Faker
            DB::table('data_warga')->insert([
                'nik' => $faker->numberBetween(2522221,423230232323),
                'dusun_id' => $faker->numberBetween(1,3),
                'rw_id' => $faker->numberBetween(1,9),
                'nama' => $faker->name,
                'alamat' => $faker->address,
                'jk' => $faker->colorName ,
                'hp' => $faker->creditCardNumber,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
             ]);
    }


    }
}
