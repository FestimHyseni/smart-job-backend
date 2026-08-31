<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CvRecommendation\StoreCvRecommendationRequest;
use App\Http\Resources\RecommendedJobResource;
use App\Services\CvRecommendationService;
use Illuminate\Http\JsonResponse;

class CvRecommendationController extends Controller
{
    public function __construct(private readonly CvRecommendationService $service)
    {
    }

    public function store(StoreCvRecommendationRequest $request): JsonResponse
    {
        $text = $this->service->extractText($request->file('cv'));
        $result = $this->service->recommend($text);

        return $this->success([
            'matched_skills' => $result['matched_skills'],
            'jobs' => RecommendedJobResource::collection($result['jobs']),
        ], 'Recommendations generated successfully.');
    }
}
