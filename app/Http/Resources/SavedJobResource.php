<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SavedJobResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'user' => new UserResource($this->whenLoaded('user')),
            'job_id' => $this->job_id,
            'job' => new JobResource($this->whenLoaded('job')),
            'created_at' => $this->created_at,
        ];
    }
}
