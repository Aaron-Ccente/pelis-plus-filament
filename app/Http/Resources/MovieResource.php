<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin MovieResource
 */
class MovieResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'release_year' => $this->release_year,

            'photo_url' => $this->photo_url 
                        ? asset('storage/' . $this->photo_url) 
                        : null,

            'background_url' => $this->background_url,
            'trailer_url' => $this->trailer_url,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
