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
      'role' => '0',
      'bank' => '0',
      'pin_bank' => '0',
      'phone' => '0',
      'id_identity_card' => '0',
      'identity_card_image' => null,
      'identity_card_image_salve' => null,
      'image' => null,
      'province' => 0,
      'district' => 0,
      'sub_district' => 0,
      'village' => '',
      'number_address' => 0,
      'description_address' => '',
      'status' => 2,
    ]);

    DB::table('users')->insert([
      'name' => 'member',
      'username' => 'member',
      'email' => 'member@gmail.com',
      'password' => bcrypt('member'),
      'role' => '1',
      'bank' => '1',
      'pin_bank' => '1',
      'phone' => '1',
      'id_identity_card' => '1',
      'identity_card_image' => null,
      'identity_card_image_salve' => null,
      'image' => null,
      'province' => 0,
      'district' => 0,
      'sub_district' => 0,
      'village' => '',
      'number_address' => 0,
      'description_address' => '',
      'status' => 2,
    ]);

    DB::table('binaries')->insert([
      'sponsor' => '1',
      'user' => '2',
    ]);
  }
}
