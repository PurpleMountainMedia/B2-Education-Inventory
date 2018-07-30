<?php

use Faker\Generator as Faker;
use App\Room;
use App\ItemType;

$factory->define(App\Item::class, function (Faker $faker) {
    $item_type_id = ItemType::first()->id;

    return [
        'room_id' => function () {
            return Room::first()->id;
        },
        'make_id' => null,
        'item_type_id' => $item_type_id,
        'barcode' => $faker->ean13,
        'name' => $faker->words(2, true),
        'description' => $faker->words(10, true),
        'serial_number' => $faker->ean13,
        'purchase_price' => $faker->numberBetween(0, 5000),
        'purchase_date' => $faker->dateTimeThisDecade(),
        // 'created_by' => $faker-> ,
    ];
});
