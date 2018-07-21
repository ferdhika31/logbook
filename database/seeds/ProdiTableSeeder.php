<?php

use Illuminate\Database\Seeder;

use App\Models\Jurusan;
use App\Models\Prodi;

class ProdiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jurusan = Jurusan::where('nama_jurusan', '=', 'Teknik Komputer dan Informatika')->first();

        // list prodi
        $listProdi = [ 
            'D3-Teknik Informatika',
            'D4-Teknik Informatika'
        ];

        foreach ($listProdi as $value) {
            $prodi = new Prodi;
            $prodi->nama_prodi = $value;
            $prodi->jurusan()->associate($jurusan);
            $prodi->save();
        }
    }
}
