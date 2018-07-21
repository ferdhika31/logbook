<?php

use Illuminate\Database\Seeder;

use App\Models\Prodi;
use App\Models\Perusahaan;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prodi = Prodi::where('nama_prodi', '=', 'D4-Teknik Informatika')->firstOrFail();
        $perusahaan = Perusahaan::where('nama_perusahaan', '=', 'PT. Gamatechno Indonesia')->firstOrFail();

        // list prodi
        $listUser = [ 
            [
                'nim'   => '151524010',
                'name'  => 'Ferdhika Yudira Diputra',
                'email' => 'ferdhika.yudira.tif415@polban.ac.id',
                'password' => bcrypt('123456'),
                'program_studi_id' => $prodi->id,
                'perusahaan_id' => $perusahaan->id,
                'created_at'	=> date('Y-m-d h:i:s'),
                'updated_at'	=> date('Y-m-d h:i:s'),
            ],
            [
                'nim'   => '151524031',
                'name'  => 'Ujang Wahyu',
                'email' => 'ujang.wahyu.tif415@polban.ac.id',
                'password' => bcrypt('123456'),
                'program_studi_id' => $prodi->id,
                'perusahaan_id' => $perusahaan->id,
                'created_at'	=> date('Y-m-d h:i:s'),
                'updated_at'	=> date('Y-m-d h:i:s'),
            ]
        ];

        foreach ($listUser as $value) {
            DB::table('users')->insert($value);
        }

    }
}
