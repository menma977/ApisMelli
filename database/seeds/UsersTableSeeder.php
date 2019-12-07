<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'rule' => '0',
            'phone' => '0',
            'id_identity_card' => '',
            'identity_card_image' => '',
            'identity_card_image_salve' => '',
            'image' => '',
            'province' => 0,
            'district' => 0,
            'sub_district' => 0,
            'village' => '',
            'number_address' => '',
            'description_address' => '',
        ]);
    }
}
