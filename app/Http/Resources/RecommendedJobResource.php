<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecommendedJobResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return array_merge(
            (new JobResource($this['job']))->toArray($request),
            ['match_score' => $this['score']],
        );
    }
}
