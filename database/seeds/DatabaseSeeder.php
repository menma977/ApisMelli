<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(provincesTableSeeder::class);
        $this->call(districtsTableSeeder::class);
        $this->call(SubDistrictsTableSeeder::class);
    }
}
