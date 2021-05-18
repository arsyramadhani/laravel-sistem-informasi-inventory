<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
