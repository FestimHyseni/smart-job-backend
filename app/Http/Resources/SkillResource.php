<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SkillResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'importance' => $this->whenPivotLoadedAs('job_skill', 'job_skills', fn () => $this->job_skill->importance),
            'level' => $this->whenPivotLoadedAs('candidate_skill', 'candidate_skills', fn () => $this->candidate_skill->level),
            'verified' => $this->whenPivotLoadedAs('candidate_skill', 'candidate_skills', fn () => $this->candidate_skill->verified),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
