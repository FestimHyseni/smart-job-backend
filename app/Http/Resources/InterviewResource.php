<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InterviewResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'application_id' => $this->application_id,
            'application' => new ApplicationResource($this->whenLoaded('application')),
            'scheduled_at' => $this->scheduled_at,
            'type' => $this->type,
            'location' => $this->location,
            'meeting_url' => $this->meeting_url,
            'notes' => $this->notes,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
