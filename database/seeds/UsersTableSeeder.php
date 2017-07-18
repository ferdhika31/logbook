<?php

use Illuminate\Database\Seeder;

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
            'name' => "Ferdhika Yudira",
            'email' => 'rpl4rt08@gmail.com',
            'password' => bcrypt('bandung0'),
            'created_at'	=> date('Y-m-d h:i:s'),
            'updated_at'	=> date('Y-m-d h:i:s'),
        ]);
    }
}
