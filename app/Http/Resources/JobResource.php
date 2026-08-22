<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'company_id' => $this->company_id,
            'company' => new CompanyResource($this->whenLoaded('company')),
            'category_id' => $this->category_id,
            'category' => new JobCategoryResource($this->whenLoaded('category')),
            'title' => $this->title,
            'description' => $this->description,
            'requirements' => $this->requirements,
            'location_id' => $this->location_id,
            'location' => new LocationResource($this->whenLoaded('location')),
            'employment_type' => $this->employment_type,
            'experience_level' => $this->experience_level,
            'salary_min' => $this->salary_min,
            'salary_max' => $this->salary_max,
            'salary_currency' => $this->salary_currency,
            'status' => $this->status,
            'deadline' => $this->deadline,
            'skills' => SkillResource::collection($this->whenLoaded('skills')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
