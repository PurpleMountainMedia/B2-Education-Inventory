<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Building extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->when(requestIncludes('buildings.extra'), $this->type),

            'created_by' => new User($this->whenLoaded('createdBy')),

            'created_at' => $this->when(requestIncludes('buildings.timestamps'), $this->created_at),
            'updated_at' => $this->when(requestIncludes('buildings.timestamps'), $this->updated_at),

            'rooms' => new RoomCollection($this->whenLoaded('rooms')),

            'rooms_count' => $this->when($this->rooms_count !== null, $this->rooms_count),

            'links' => $this->links,
        ];
    }
}
