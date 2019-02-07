<?php

use Faker\Generator as Faker;

$factory->define(\App\Product::class, function (Faker $faker) {
    $price = $faker->randomFloat(3, 5, 999);

    return [
        'name'         => $faker->text(20),
        'sku'          => $faker->unique()->randomNumber(3),
        'status'       => true,
        'basePrice'    => $price,
        'specialPrice' => $price - $price * 0.1,
        'description'  => $faker->paragraph,
    ];
});
