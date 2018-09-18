<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Item extends JsonResource
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

            'description' => $this->when(requestIncludes('items.extra'), $this->description),
            'serial_number' => $this->when(requestIncludes('items.extra'), $this->serial_number),
            'purchase_price' => $this->when(requestIncludes('items.extra'), $this->purchase_price),
            'purchase_date' => $this->when(requestIncludes('items.extra'), $this->purchase_date),
            'meta' => $this->when(requestIncludes('items.extra'), $this->meta),
            'write_off' => $this->when(requestIncludes('items.extra'), $this->write_off),
            'missing_at' => $this->when(requestIncludes('items.extra'), $this->missing_at),

            'room' => new Room($this->whenLoaded('room')),
            'make' => new Make($this->whenLoaded('make')),
            'category' => new ItemCategory($this->whenLoaded('itemCategory')),
            'created_by' => new User($this->whenLoaded('createdBy')),

            'created_at' => $this->when(requestIncludes('items.timestamps'), $this->created_at),
            'updated_at' => $this->when(requestIncludes('items.timestamps'), $this->updated_at),

            'links' => $this->links,
        ];
    }
}
