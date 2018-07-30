<?php

use Faker\Generator as Faker;

$factory->define(App\Room::class, function (Faker $faker) {
    return [
        "name" => "Room {$faker->words(1, true)}",
        "type" => $faker->boolean ? "Room" : "Other",
    ];
});
