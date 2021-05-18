<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Supplier;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Supplier::class, function (Faker $faker) {
    return [
        //
        'nama_supplier'   => $faker->company,
        'alamat_supplier' => $faker->streetAddress,
        'kota_supplier'   => $faker->city,
        'telepon'         => $faker->phoneNumber,
    ];
});
