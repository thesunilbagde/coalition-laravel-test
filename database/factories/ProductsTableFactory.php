<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
      
      "products_details" => [
        "product_name"  => $faker->name,
        "product_description"  => mb_substr($faker->text, 0, 100),
        "quantity_in_stock" => $faker->randomNumber(2) ,
        "price_per_item" => $faker->randomNumber(2),
        "created_at" =>
        $faker->dateTimeBetween('-2 days', 'now')->format("Y-m-d H:i:d"),
        "updated_at" => $faker->dateTimeBetween('-1 day', 'now')->format("Y-m-d H:i:d")
       ]
    ];
});
