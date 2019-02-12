<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Config;

$factory->define(\App\Product::class, function (Faker $faker) {
    $price = round($faker->randomFloat(3, 5, 999),1);

    return [
        'name'         => $faker->text(20),
        'sku'          => $faker->unique()->randomNumber(3),
        'status'       => true,
        'basePrice'    => $price,
        'specialPrice' => $price - $price * 0.1,
        'description'  => $faker->paragraph,
        'image' =>  $faker->image(public_path(Config::get('assets.images')),400,300,null,false),
    ];
});
