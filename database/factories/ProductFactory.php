<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Config;

$factory->define(\App\Product::class, function (Faker $faker) {
    return [
        'name'        => $faker->text(20),
        'sku'         => $faker->unique()->randomNumber(3),
        'status'      => true,
        'basePrice'   => round($faker->randomFloat(3, 5, 600), 2),
        'description' => $faker->paragraph,
        'image'       => $faker->image(public_path(Config::get('assets.images')), 400, 300, null, false),
    ];
});
