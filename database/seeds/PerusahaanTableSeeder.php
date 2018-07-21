<?php

use Illuminate\Database\Seeder;

class PerusahaanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('perusahaan')->insert([
            'nama_perusahaan'   => 'PT. Gamatechno Indonesia',
            'created_at'	=> date('Y-m-d h:i:s'),
            'updated_at'	=> date('Y-m-d h:i:s'),
        ]);
    }
}
