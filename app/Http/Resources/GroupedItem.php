<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Room;
use App\Building;

class GroupedItem extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $room = new Room(['id' => $this->room_id, 'name' => $this->room_name]);
        $building = new Building(['id' => $this->building_id, 'name' => $this->building_name]);
        return [
            'name' => $this->name,

            'item_count' => $this->item_count,

            'room' => [
                'id' => $room->id,
                'name' => $room->name,
                'links' => $room->links
            ],

            'building' => [
                'id' => $building->id,
                'name' => $building->name,
                'links' => $building->links
            ],

            'item_category' => [
                'id' => $this->item_category_id,
                'name' => $this->item_category_name
            ],

            'links' => [
                'url' => route('web.items.show_group', [$this->item_category_id, $room->id, $this->name])
            ],
        ];
    }
}
