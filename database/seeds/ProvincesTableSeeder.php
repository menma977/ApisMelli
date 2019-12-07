<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class provincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('provinces')->insert([
            'code' => 11,
            'name' => 'Aceh',
        ]);
        DB::table('provinces')->insert([
            'code' => 12,
            'name' => 'Sumatera Utara',
        ]);
        DB::table('provinces')->insert([
            'code' => 13,
            'name' => 'Sumatera Barat',
        ]);
        DB::table('provinces')->insert([
            'code' => 14,
            'name' => 'Riau',
        ]);
        DB::table('provinces')->insert([
            'code' => 15,
            'name' => 'Jambi',
        ]);
        DB::table('provinces')->insert([
            'code' => 16,
            'name' => 'Sumatera Selatan',
        ]);
        DB::table('provinces')->insert([
            'code' => 17,
            'name' => 'Bengkulu',
        ]);
        DB::table('provinces')->insert([
            'code' => 18,
            'name' => 'Lampung',
        ]);
        DB::table('provinces')->insert([
            'code' => 19,
            'name' => 'Kepulauan Bangka Belitung',
        ]);
        DB::table('provinces')->insert([
            'code' => 21,
            'name' => 'Kepulauan Riau',
        ]);
        DB::table('provinces')->insert([
            'code' => 31,
            'name' => 'Dki Jakarta',
        ]);
        DB::table('provinces')->insert([
            'code' => 32,
            'name' => 'Jawa Barat',
        ]);
        DB::table('provinces')->insert([
            'code' => 33,
            'name' => 'Jawa Tengah',
        ]);
        DB::table('provinces')->insert([
            'code' => 34,
            'name' => 'Di Yogyakarta',
        ]);
        DB::table('provinces')->insert([
            'code' => 35,
            'name' => 'Jawa Timur',
        ]);
        DB::table('provinces')->insert([
            'code' => 36,
            'name' => 'Banten',
        ]);
        DB::table('provinces')->insert([
            'code' => 51,
            'name' => 'Bali',
        ]);
        DB::table('provinces')->insert([
            'code' => 52,
            'name' => 'Nusa Tenggara Barat',
        ]);
        DB::table('provinces')->insert([
            'code' => 53,
            'name' => 'Nusa Tenggara Timur',
        ]);
        DB::table('provinces')->insert([
            'code' => 61,
            'name' => 'Kalimantan Barat',
        ]);
        DB::table('provinces')->insert([
            'code' => 62,
            'name' => 'Kalimantan Tengah',
        ]);
        DB::table('provinces')->insert([
            'code' => 63,
            'name' => 'Kalimantan Selatan',
        ]);
        DB::table('provinces')->insert([
            'code' => 64,
            'name' => 'Kalimantan Timur',
        ]);
        DB::table('provinces')->insert([
            'code' => 65,
            'name' => 'Kalimantan Utara',
        ]);
        DB::table('provinces')->insert([
            'code' => 71,
            'name' => 'Sulawesi Utara',
        ]);
        DB::table('provinces')->insert([
            'code' => 72,
            'name' => 'Sulawesi Tengah',
        ]);
        DB::table('provinces')->insert([
            'code' => 73,
            'name' => 'Sulawesi Selatan',
        ]);
        DB::table('provinces')->insert([
            'code' => 74,
            'name' => 'Sulawesi Tenggara',
        ]);
        DB::table('provinces')->insert([
            'code' => 75,
            'name' => 'Gorontalo',
        ]);
        DB::table('provinces')->insert([
            'code' => 76,
            'name' => 'Sulawesi Barat',
        ]);
        DB::table('provinces')->insert([
            'code' => 81,
            'name' => 'Maluku',
        ]);
        DB::table('provinces')->insert([
            'code' => 82,
            'name' => 'Maluku Utara',
        ]);
        DB::table('provinces')->insert([
            'code' => 91,
            'name' => 'Papua Barat',
        ]);
        DB::table('provinces')->insert([
            'code' => 94,
            'name' => 'Papua',
        ]);
    }
}
