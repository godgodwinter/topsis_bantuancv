<?php

namespace Database\Seeders;


use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => '$2y$10$oOhE/tcF8MC9crGCw/Zv5.zFMGu0JLm591undChCaHJM6YrnGjgCu',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);


        DB::table('users')->insert([
            'name' => 'Kepala Desa',
            'email' => 'kades@gmail.com',
            'current_team_id' => '1',
            'password' => '$2y$10$oOhE/tcF8MC9crGCw/Zv5.zFMGu0JLm591undChCaHJM6YrnGjgCu',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);



        DB::table('dusun')->insert([
            'id' => '1',
            'nama' => 'Krajan',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

        DB::table('dusun')->insert([
            'id' => '2',
            'nama' => 'Sidodadi',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

        DB::table('dusun')->insert([
            'id' => '3',
            'nama' => 'Sumbersari',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

        DB::table('rw')->insert([
            'nama' => 'RW 1',
            'dusun_id' => '1',
            'dusun_nama' => 'Krajan',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

         DB::table('rw')->insert([
             'nama' => 'RW 2',
             'dusun_id' => '1',
             'dusun_nama' => 'Krajan',
             'created_at' => Carbon::now(),
             'updated_at' => Carbon::now()
          ]);


        DB::table('rw')->insert([
            'nama' => 'RW 3',
            'dusun_id' => '1',
            'dusun_nama' => 'Krajan',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);


        DB::table('rw')->insert([
            'nama' => 'RW 4',
            'dusun_id' => '2',
            'dusun_nama' => 'Sidodadi',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

         DB::table('rw')->insert([
             'nama' => 'RW 5',
             'dusun_id' => '2',
             'dusun_nama' => 'Sidodadi',
             'created_at' => Carbon::now(),
             'updated_at' => Carbon::now()
          ]);

          DB::table('rw')->insert([
              'nama' => 'RW 6',
              'dusun_id' => '2',
              'dusun_nama' => 'Sidodadi',
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now()
           ]);
         

          DB::table('rw')->insert([
            'nama' => 'RW 7',
            'dusun_id' => '3',
            'dusun_nama' => 'Sumbersari',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

         DB::table('rw')->insert([
           'nama' => 'RW 8',
           'dusun_id' => '3',
           'dusun_nama' => 'Sumbersari',
           'created_at' => Carbon::now(),
           'updated_at' => Carbon::now()
        ]);

        DB::table('rw')->insert([
          'nama' => 'RW 9',
          'dusun_id' => '3',
          'dusun_nama' => 'Sumbersari',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
       ]);
    }
}
