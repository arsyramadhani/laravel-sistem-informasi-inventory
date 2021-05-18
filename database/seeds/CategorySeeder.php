<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
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
    }
}
