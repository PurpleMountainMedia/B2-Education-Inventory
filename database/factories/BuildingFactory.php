<?php

use Faker\Generator as Faker;

$factory->define(App\Building::class, function (Faker $faker) {
    return [
        "name" => "Building {$faker->words(1, true)}",
        "type" => $faker->boolean ? "Building" : "Outside",
        "school_id" => $faker->uuid
    ];
});
