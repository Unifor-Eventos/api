<?php

namespace App\Http\Resources\Event;

use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class EventParticipantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user' => UserResource::make($this->resource),
            'resume' => $this->pivot->resume,
            'resume_url' => Storage::url($this->pivot->resume_url),
            'status' => $this->pivot->status,
            'approved_at' => $this->pivot->approved_at,
        ];
    }
}
