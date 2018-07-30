<?php

use Faker\Generator as Faker;

$factory->define(App\ItemType::class, function (Faker $faker) {
    return [
        'name' => $faker->words(2, true),
        'description' => $faker->words(10, true)
    ];
});
