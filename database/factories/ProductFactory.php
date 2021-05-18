<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        //
            'nama_barang' => $faker->sentence($nbWords = 2),
            'harga_jual'  => $faker->randomNumber($nbDigits = 5),
            'category_id' => $faker->numberBetween($min = 1, $max = 5),
            'unit_id'     => $faker->numberBetween($min = 1, $max = 6),
            'min_stok'    => 3,
    ];
});
