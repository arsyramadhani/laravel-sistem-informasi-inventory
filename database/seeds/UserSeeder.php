<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('users')->insert([
                'username' => 'admin',
                'nama' => 'admin',
                'password' => Hash::make('admin'),
                'akses' => 1,
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            DB::table('users')->insert([
                'username' => 'apoteker',
                'nama' => 'apoteker',
                'password' => Hash::make('apoteker'),
                'akses' => 2,
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            DB::table('users')->insert([
                'username' => 'user',
                'nama' => 'user',
                'password' => Hash::make('user'),
                'akses' => 3,
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            DB::table('users')->insert([
                'username' => 'kasir',
                'nama' => 'kasir',
                'password' => Hash::make('kasir'),
                'akses' => 4,
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
    }
}
