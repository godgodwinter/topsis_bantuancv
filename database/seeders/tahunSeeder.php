<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tahunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('th_penerimaan')->insert([
            'tahun' => 2020,
            'status' => 'Proses',
            'kuota' => '10',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

         DB::table('th_penerimaan')->insert([
            'tahun' => 2021,
            'status' => 'Proses',
            'kuota' => '15',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);
    }
}
