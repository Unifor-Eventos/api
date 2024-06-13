<?php

namespace App\Http\Resources\Event;

use App\Http\Resources\DateResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

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
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'description' => $this->resource->description,
            'slug' => $this->resource->slug,
            'banner' => Storage::url($this->resource->banner_url),
            'organizer' => UserResource::make($this->resource->organizer),
            'is_virtual' => $this->resource->is_virtual,
            'start_at' => $this->resource->start_at,
            'finish_at' => $this->resource->finish_at,
            'start_at' => $this->resource->start_at,
            'created_at' => DateResource::make($this->resource->created_at)
        ];
    }
}
