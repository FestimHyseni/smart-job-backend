<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobViewResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'job_id' => $this->job_id,
            'job' => new JobResource($this->whenLoaded('job')),
            'user_id' => $this->user_id,
            'user' => new UserResource($this->whenLoaded('user')),
            'ip_address' => $this->ip_address,
            'viewed_at' => $this->viewed_at,
        ];
    }
}
