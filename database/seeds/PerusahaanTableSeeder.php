<?php

use Illuminate\Database\Seeder;

use App\Models\Perusahaan;

class PerusahaanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // list jurusan
        $listPerusahaan = [ 
            'PT. Gamatechno Indonesia',
            'CV. Garuda Infinity Kreasindo',
            'CV. Tujuh Sembilan',
            'PT. Bejana Investidata Globalindo (BIG)',
            'PT. Bee Solutions Partner',
            'PT. Ciptadra Softindo',
            'PT. Fujitsu Indonesia',
            'PT. Kazee Indonesia',
            'PT. Myabuy Global Technology',
            'PT. Neuronworks Indonesia',
            'PT. NTT Data Indonesia',
            'PT. Periplus Bookindo',
            'PT. Ursabyte',
            'Zetta Byte Pte. Ltd.'
        ];

        foreach ($listPerusahaan as $value) {
            $perusahaan = new Perusahaan;
            $perusahaan->nama_perusahaan = $value;
            $perusahaan->save();
        }

        // DB::table('perusahaan')->insert([
        //     'nama_perusahaan'   => 'PT. Gamatechno Indonesia',
        //     'created_at'	=> date('Y-m-d h:i:s'),
        //     'updated_at'	=> date('Y-m-d h:i:s'),
        // ]);
    }
}
