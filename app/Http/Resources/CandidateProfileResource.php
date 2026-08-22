<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CandidateProfileResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'user' => new UserResource($this->whenLoaded('user')),
            'headline' => $this->headline,
            'bio' => $this->bio,
            'location_id' => $this->location_id,
            'location' => new LocationResource($this->whenLoaded('location')),
            'years_experience' => $this->years_experience,
            'expected_salary' => $this->expected_salary,
            'salary_currency' => $this->salary_currency,
            'linkedin_url' => $this->linkedin_url,
            'github_url' => $this->github_url,
            'portfolio_url' => $this->portfolio_url,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
