<?php

namespace App\Http\Resources\Event;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->name,
            'description' => $this->description,
            'slug' => $this->slug,
            'is_virtual' => $this->is_virtual,
            'start_at' => $this->start_at,
            'finish_at' => $this->finish_at,
            'start_at' => $this->start_at,
            'created_at' => $this->created_at?->diffForHumans()
        ];
    }
}
