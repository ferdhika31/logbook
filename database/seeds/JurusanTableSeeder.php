<?php

use Illuminate\Database\Seeder;

use App\Models\Jurusan;

class JurusanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // list jurusan
        $listJurusan = [ 
            'Administrasi Niaga',
            'Teknik Sipil',
            'Teknik Mesin',
            'Teknik Refrigasi dan Tata Udara',
            'Teknik Komputer dan Informatika',
            'Teknik Konversi Energi',
            'Teknik Elektro',
            'Teknik Kimia',
            'Akuntansi',
            'Bahasa Inggris'
        ];

        foreach ($listJurusan as $value) {
            $jurusan = new Jurusan;
            $jurusan->nama_jurusan = $value;
            $jurusan->save();
        }

    }
}
