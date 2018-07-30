<?php

use Illuminate\Database\Seeder;
use App\Room;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rooms = Room::all();

        foreach ($rooms as $key => $room) {
            factory(App\Item::class, 30)
                   ->create([
                      'room_id' => $room->id,
                   ]);
        }
    }
}
