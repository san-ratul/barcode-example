<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(4),
        'desc' => $faker->paragraph(15),
        'qty' => rand(50,1000),
        'price' => rand(150,1500),
        'barcode' => substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 9),
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
