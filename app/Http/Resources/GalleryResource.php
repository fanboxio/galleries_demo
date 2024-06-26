<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GalleryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'grid_size' => $this->grid_size,
            'description' => $this->description,
            'creator' => UserResource::make($this->creator),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
