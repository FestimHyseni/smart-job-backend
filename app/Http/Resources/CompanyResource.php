<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'logo' => $this->logo,
            'website' => $this->website,
            'location_id' => $this->location_id,
            'location' => new LocationResource($this->whenLoaded('location')),
            'industry' => $this->industry,
            'employees_count' => $this->employees_count,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
