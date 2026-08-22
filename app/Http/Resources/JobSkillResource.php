<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobSkillResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'job_id' => $this->job_id,
            'job' => new JobResource($this->whenLoaded('job')),
            'skill_id' => $this->skill_id,
            'skill' => new SkillResource($this->whenLoaded('skill')),
            'importance' => $this->importance,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
