<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StarterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categories')->insert([
            'nama_kategori' => 'Obat Wajib Apotek',
        ]);
        DB::table('categories')->insert([
            'nama_kategori' => 'Obat Bebas',
        ]);
        DB::table('categories')->insert([
            'nama_kategori' => 'Obat Keras',
        ]);
        DB::table('categories')->insert([
            'nama_kategori' => 'Obat Herbal',
        ]);
        DB::table('categories')->insert([
            'nama_kategori' => 'Obat Lainnya',
        ]);
        DB::table('units')->insert([
            'nama_unit' => 'Strip',
        ]);
        DB::table('units')->insert([
            'nama_unit' => 'Sachet',
        ]);
        DB::table('units')->insert([
            'nama_unit' => 'Botol',
        ]);
        DB::table('units')->insert([
            'nama_unit' => 'Box',
        ]);
        DB::table('units')->insert([
            'nama_unit' => 'Blister',
        ]);
        DB::table('units')->insert([
            'nama_unit' => 'Pcs',
        ]);
        DB::table('stores')->insert([
            'nama' => 'Apotek Alba',
            'alamat' => 'Jl Raya Bhayangkara, Cipocok Jaya',
            'kota' => 'Kota Serang',
            'telepon' => '(0254) 224 121',
            'apoteker' => 'Maya Shinta Tresnawati, S.Farm, Apt',
            'sipa' => 'No. 800/55/SIPA-PKP/I/2017',
            'apa' => 'Maya Shinta Tresnawati, S.Farm, Apt',
        ]);
    }
}
