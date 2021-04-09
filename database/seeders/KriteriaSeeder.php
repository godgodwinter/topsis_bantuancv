<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('kriteria')->insert([
            'id' => 1,
            'nama' => 'Penghasilan Keluarga',
            'nilai' => '4',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

         DB::table('kriteria')->insert([
            'id' => 2,
            'nama' => 'Tanggungan Keluarga',
            'nilai' => '5',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

         DB::table('kriteria')->insert([
            'id' => 3,
            'nama' => 'Status Kawin',
            'nilai' => '2',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

         DB::table('kriteria')->insert([
            'id' => 4,
            'nama' => 'Umur',
            'nilai' => '3',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

         DB::table('kriteria')->insert([
            'id' => 5,
            'nama' => 'Tempat Tinggal',
            'nilai' => '4',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

         DB::table('kriteria')->insert([
            'id' => 6,
            'nama' => 'Memiliki kendaraan',
            'nilai' => '4',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

         DB::table('kriteria')->insert([
            'id' => 7,
            'nama' => 'Pekerjaan',
            'nilai' => '4',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

//setting Penghasilan Keluarga
         DB::table('setting_range')->insert([
            [
                'kriteria_id' => 1,
                'tanda' => 'Lebih dari sama dengan',
                'nilai1' => '5.000.000 ke atas',
                'nilai2' => '0',
                'bobot' => '1',
                'tipe' => 'tanpatanda',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'kriteria_id' => 1,
                'tanda' => 'Diantara',
                'nilai1' => '2.000.000 s/d 1.500.000 ',
                'nilai2' => '0',
                'bobot' => '2',
                'tipe' => 'tanpatanda',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'kriteria_id' => 1,
                'tanda' => 'Diantara',
                'nilai1' => '< 1.500.000 s/d 1.000.000 ',
                'nilai2' => '0',
                'bobot' => '3',
                'tipe' => 'tanpatanda',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'kriteria_id' => 1,
                'tanda' => 'Diantara',
                'nilai1' => '<1.000.000 s/d 500.000 ',
                'nilai2' => '0',
                'bobot' => '4',
                'tipe' => 'tanpatanda',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'kriteria_id' => 1,
                'tanda' => 'Kurang dari sama dengan',
                'nilai1' => 'Kurang dari 500.000',
                'nilai2' => '0',
                'bobot' => '5',
                'tipe' => 'tanpatanda',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);


//setting Tanggungan keluarga
DB::table('setting_range')->insert([
    [
        'kriteria_id' => 2,
        'tanda' => 'Lebih dari sama dengan',
        'nilai1' => 'Tidak memiliki anak',
        'nilai2' => '0',
        'bobot' => '1',
        'tipe' => 'tanpatanda',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ],
    [
        'kriteria_id' => 2,
        'tanda' => 'Diantara',
        'nilai1' => '1 s/d 2 Anak',
        'nilai2' => '1500000',
        'bobot' => '2',
        'tipe' => 'tanpatanda',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ],
    [
        'kriteria_id' => 2,
        'tanda' => 'Diantara',
        'nilai1' => '3 s/d 4 Anak ',
        'nilai2' => '1000000',
        'bobot' => '3',
        'tipe' => 'tanpatanda',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ],
    [
        'kriteria_id' => 2,
        'tanda' => 'Diantara',
        'nilai1' => 'Memiliki anak usia sekolah',
        'nilai2' => '500000',
        'bobot' => '4',
        'tipe' => 'tanpatanda',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ],
    [
        'kriteria_id' => 2,
        'tanda' => 'Kurang dari sama dengan',
        'nilai1' => 'Memiliki anak usia dini atau ibu hamil	5',
        'nilai2' => '1000000',
        'bobot' => '5',
        'tipe' => 'tanpatanda',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ]
]);

//setting Status Kawin
DB::table('setting_range')->insert([
    [
        'kriteria_id' => 3,
        'tanda' => 'Lebih dari sama dengan',
        'nilai1' => 'Belum Kawin',
        'nilai2' => '0',
        'bobot' => '1',
        'tipe' => 'tanpatanda',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ],
    [
        'kriteria_id' => 3,
        'tanda' => 'Diantara',
        'nilai1' => 'Kawin (Belum Tercatat)',
        'nilai2' => '0',
        'bobot' => '2',
        'tipe' => 'tanpatanda',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ],
    [
        'kriteria_id' => 3,
        'tanda' => 'Diantara',
        'nilai1' => 'Kawin (Tercatat)',
        'nilai2' => '0',
        'bobot' => '3',
        'tipe' => 'tanpatanda',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ],
    [
        'kriteria_id' => 3,
        'tanda' => 'Diantara',
        'nilai1' => 'Cerai Hidup ',
        'nilai2' => '0',
        'bobot' => '4',
        'tipe' => 'tanpatanda',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ],
    [
        'kriteria_id' => 3,
        'tanda' => 'Kurang dari sama dengan',
        'nilai1' => 'Cerai Mati',
        'nilai2' => '0',
        'bobot' => '5',
        'tipe' => 'tanpatanda',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ]
]);


//setting Umur
DB::table('setting_range')->insert([
    [
        'kriteria_id' => 4,
        'tanda' => 'Lebih dari sama dengan',
        'nilai1' => '20 s/d 25 Tahun',
        'nilai2' => '0',
        'bobot' => '1',
        'tipe' => 'tanpatanda',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ],
    [
        'kriteria_id' => 4,
        'tanda' => 'Diantara',
        'nilai1' => '25 s/d 30 Tahun',
        'nilai2' => '0',
        'bobot' => '2',
        'tipe' => 'tanpatanda',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ],
    [
        'kriteria_id' => 4,
        'tanda' => 'Diantara',
        'nilai1' => '31 s/d 40 Tahun ',
        'nilai2' => '0',
        'bobot' => '3',
        'tipe' => 'tanpatanda',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ],
    [
        'kriteria_id' => 4,
        'tanda' => 'Diantara',
        'nilai1' => '41 s/d 50 Tahun ',
        'nilai2' => '0',
        'bobot' => '4',
        'tipe' => 'tanpatanda',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ],
    [
        'kriteria_id' => 4,
        'tanda' => 'Kurang dari sama dengan',
        'nilai1' => 'Diatas 50 Tahun',
        'nilai2' => '0',
        'bobot' => '5',
        'tipe' => 'tanpatanda',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ]
]);


//setting Tempat Tinggal
DB::table('setting_range')->insert([
    [
        'kriteria_id' => 5,
        'tanda' => 'Lebih dari sama dengan',
        'nilai1' => 'Milik pribadi  ',
        'nilai2' => '0',
        'bobot' => '1',
        'tipe' => 'tanpatanda',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ],
    [
        'kriteria_id' => 5,
        'tanda' => 'Diantara',
        'nilai1' => 'Mukim dengan keluarga ',
        'nilai2' => '0',
        'bobot' => '2',
        'tipe' => 'tanpatanda',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ],
    [
        'kriteria_id' => 5,
        'tanda' => 'Diantara',
        'nilai1' => 'Mengontrak   ',
        'nilai2' => '0',
        'bobot' => '3',
        'tipe' => 'tanpatanda',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ],
    [
        'kriteria_id' => 5,
        'tanda' => 'Diantara',
        'nilai1' => 'Menumpang  ',
        'nilai2' => '0',
        'bobot' => '4',
        'tipe' => 'tanpatanda',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ],
    [
        'kriteria_id' => 5,
        'tanda' => 'Kurang dari sama dengan',
        'nilai1' => 'Tidak punya tempat
        tinggal',
        'nilai2' => '0',
        'bobot' => '5',
        'tipe' => 'tanpatanda',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ]
]);

//setting Memiliki kendaraan
DB::table('setting_range')->insert([
    [
        'kriteria_id' => 6,
        'tanda' => 'Lebih dari sama dengan',
        'nilai1' => 'Kendaraan Roda 4  ',
        'nilai2' => '0',
        'bobot' => '1',
        'tipe' => 'tanpatanda',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ],
    [
        'kriteria_id' => 6,
        'tanda' => 'Diantara',
        'nilai1' => 'Kendaraan Roda 2  ',
        'nilai2' => '0',
        'bobot' => '2',
        'tipe' => 'tanpatanda',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ],
    [
        'kriteria_id' => 6,
        'tanda' => 'Diantara',
        'nilai1' => 'Kendaraan roda 3  ',
        'nilai2' => '0',
        'bobot' => '3',
        'tipe' => 'tanpatanda',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ],
    [
        'kriteria_id' => 6,
        'tanda' => 'Diantara',
        'nilai1' => 'Kendaraan Sepeda  ',
        'nilai2' => '0',
        'bobot' => '4',
        'tipe' => 'tanpatanda',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ],
    [
        'kriteria_id' => 6,
        'tanda' => 'Kurang dari sama dengan',
        'nilai1' => 'Tidak memiliki
        kendaraan',
        'nilai2' => '0',
        'bobot' => '5',
        'tipe' => 'tanpatanda',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ]
]);
//setting Pekerjaan
DB::table('setting_range')->insert([
    [
        'kriteria_id' => 7,
        'tanda' => 'Lebih dari sama dengan',
        'nilai1' => 'PNS/Guru ',
        'nilai2' => '0',
        'bobot' => '1',
        'tipe' => 'tanpatanda',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ],
    [
        'kriteria_id' => 7,
        'tanda' => 'Diantara',
        'nilai1' => 'Karyawan Swasta',
        'nilai2' => '0',
        'bobot' => '2',
        'tipe' => 'tanpatanda',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ],
    [
        'kriteria_id' => 7,
        'tanda' => 'Diantara',
        'nilai1' => 'Pedagang ',
        'nilai2' => '0',
        'bobot' => '3',
        'tipe' => 'tanpatanda',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ],
    [
        'kriteria_id' => 7,
        'tanda' => 'Diantara',
        'nilai1' => 'Petani  ',
        'nilai2' => '0',
        'bobot' => '4',
        'tipe' => 'tanpatanda',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ],
    [
        'kriteria_id' => 7,
        'tanda' => 'Kurang dari sama dengan',
        'nilai1' => 'Buruh',
        'nilai2' => '0',
        'bobot' => '5',
        'tipe' => 'tanpatanda',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ]
]);
    }
}
