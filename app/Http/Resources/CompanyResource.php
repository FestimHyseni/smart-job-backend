<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CompanyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'logo' => $this->logo,
            'logo_url' => $this->logo ? Storage::url($this->logo) : null,
            'website' => $this->website,
            'location_id' => $this->location_id,
            'location' => new LocationResource($this->whenLoaded('location')),
            'industry' => $this->industry,
            'employees_count' => $this->employees_count,
            'is_followed' => $request->user()
                ? $this->followers()->where('user_id', $request->user()->id)->exists()
                : false,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
