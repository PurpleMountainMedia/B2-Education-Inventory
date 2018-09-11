<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Make extends JsonResource
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

            'created_at' => $this->when(requestIncludes('itemCategory.timestamps'), $this->created_at),
            'updated_at' => $this->when(requestIncludes('itemCategory.timestamps'), $this->updated_at),

            'links' => $this->links,
        ];
    }
}
