<?php

namespace App\Http\Resources\Event;

use App\Http\Resources\DateResource;
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
            'title' => $this->resource->title,
            'description' => $this->resource->description,
            'slug' => $this->resource->slug,
            'is_virtual' => $this->resource->is_virtual,
            'start_at' => $this->resource->start_at,
            'finish_at' => $this->resource->finish_at,
            'start_at' => $this->resource->start_at,
            'created_at' => DateResource::make($this->resource->created_at)
        ];
    }
}
