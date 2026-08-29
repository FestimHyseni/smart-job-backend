<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CandidateDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'avatar_url' => $this->avatar ? Storage::url($this->avatar) : null,
            'profile' => $this->whenLoaded('candidateProfile', fn () => $this->candidateProfile ? new CandidateProfileResource($this->candidateProfile) : null),
            'skills' => CandidateSkillResource::collection($this->whenLoaded('candidateSkills')),
            'experiences' => ExperienceResource::collection($this->whenLoaded('experiences')),
            'educations' => EducationResource::collection($this->whenLoaded('educations')),
            'languages' => CandidateLanguageResource::collection($this->whenLoaded('candidateLanguages')),
            'resumes' => ResumeResource::collection($this->whenLoaded('resumes')),
        ];
    }
}
