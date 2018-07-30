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
            'created_at' => $this->when(requestIncludes('items.timestamps'), $this->created_at),
            'updated_at' => $this->when(requestIncludes('items.timestamps'), $this->updated_at),
        ];
    }
}
