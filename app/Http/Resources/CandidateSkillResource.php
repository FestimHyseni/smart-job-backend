<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CandidateSkillResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'user' => new UserResource($this->whenLoaded('user')),
            'skill_id' => $this->skill_id,
            'skill' => new SkillResource($this->whenLoaded('skill')),
            'level' => $this->level,
            'verified' => $this->verified,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
