<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ResumeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'user' => new UserResource($this->whenLoaded('user')),
            'file_name' => $this->file_name,
            'file_path' => $this->file_path,
            'file_url' => Storage::url($this->file_path),
            'is_default' => $this->is_default,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
