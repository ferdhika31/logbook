<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(JurusanTableSeeder::class);
        $this->call(ProdiTableSeeder::class);
        $this->call(PerusahaanTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
