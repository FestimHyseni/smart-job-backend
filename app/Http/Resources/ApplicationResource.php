<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'job_id' => $this->job_id,
            'job' => new JobResource($this->whenLoaded('job')),
            'candidate_id' => $this->candidate_id,
            'candidate' => new UserResource($this->whenLoaded('candidate')),
            'resume_id' => $this->resume_id,
            'resume' => new ResumeResource($this->whenLoaded('resume')),
            'cover_letter' => $this->cover_letter,
            'experience_summary' => $this->experience_summary,
            'languages' => $this->languages,
            'status' => $this->status,
            'applied_at' => $this->applied_at,
            'interviews' => InterviewResource::collection($this->whenLoaded('interviews')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
