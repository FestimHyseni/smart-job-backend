<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobViewStatsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'job_id' => $this->job_id,
            'job' => new JobResource($this->whenLoaded('job')),
            'date' => $this->date,
            'views_count' => $this->views_count,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
