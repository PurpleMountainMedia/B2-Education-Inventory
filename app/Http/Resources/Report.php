<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Report extends JsonResource
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

            'type' => $this->when(requestIncludes('reports.extra'), $this->type),

            'content' => $this->when(requestIncludes('reports.content'), $this->formatted_data),

            'created_at' => $this->when(requestIncludes('reports.timestamps'), $this->created_at),
            'updated_at' => $this->when(requestIncludes('reports.timestamps'), $this->updated_at),

            'created_by' => new User($this->whenLoaded('createdBy')),

            'links' => $this->links,
        ];
    }
}
