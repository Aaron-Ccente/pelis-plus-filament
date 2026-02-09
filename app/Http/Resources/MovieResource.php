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
            'photo_url' => asset('storage/' . $this->photo_url),
            'genres' => $this->whenLoaded('genres', function () {
                return $this->genres->pluck('name');
            }),  ];
    }
}
