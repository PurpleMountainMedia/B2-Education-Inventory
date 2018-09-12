<?php

namespace App\Services;

use App\Room;
use Auth;
use Illuminate\Support\Str;

class RoomService
{
    use MapToTrait;

    protected $returnData;

    public function roomsFromNames($items)
    {
        $newRooms = [];
        $existingRooms = Room::where(function ($query) use ($items) {
            foreach ($items as $key => $item) {
                $query->orWhere([
                    ['name', 'like', '%' . ($item['room'] ?? null) . '%'],
                    ['building_id', optional($item['building'])->id]
                ]);
            }
        })->get();

        $existingRoomNames = $existingRooms->map(function ($room) {
            $name = strtolower($room->name);
            return "$name-$room->building_id";
        })->toArray();

        $roomsToCreate = [];
        foreach ($items as $key => $item) {
            $room = $item['room'];
            $roomName = trim(strtolower($room));
            $buildingId = optional($item['building'])->id;
            if (!in_array("$roomName-$buildingId", $existingRoomNames)) {
                $room = $this->newRoomFromName($buildingId, $item['room']);
                $newRooms[] = $room;
                $roomsToCreate[] = $room->toArray();
            }
        }
        Room::insert($roomsToCreate);

        $this->returnData = $existingRooms->merge($newRooms);

        return $this;
    }

    public function newRoomFromName($buildingId, $name)
    {
        return new Room([
            'id' => (string) Str::uuid(),
            'building_id' => $buildingId,
            'type' => 'Room',
            'created_by' => Auth::user()->id,
            'name' => trim($name),
            'created_at' => now()->toDateTimeString(),
            'updated_at' => now()->toDateTimeString(),
        ]);
    }
}
