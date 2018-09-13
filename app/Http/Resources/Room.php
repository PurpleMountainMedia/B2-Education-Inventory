<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Room extends JsonResource
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
            'type' => $this->when(requestIncludes('rooms.extra'), $this->type),
            'created_at' => $this->when(requestIncludes('rooms.timestamps'), $this->created_at),
            'updated_at' => $this->when(requestIncludes('rooms.timestamps'), $this->updated_at),

            'items' => new ItemCollection($this->whenLoaded('items')),
            'building' => new Building($this->whenLoaded('building')),

            'links' => $this->links,
        ];
    }
}
