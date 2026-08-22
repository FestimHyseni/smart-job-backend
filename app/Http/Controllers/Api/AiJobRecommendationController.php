<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AiJobRecommendation\StoreAiJobRecommendationRequest;
use App\Http\Requests\AiJobRecommendation\UpdateAiJobRecommendationRequest;
use App\Http\Resources\AiJobRecommendationResource;
use App\Models\AiJobRecommendation;
use App\Services\AiJobRecommendationService;
use Illuminate\Http\JsonResponse;

class AiJobRecommendationController extends Controller
{
    public function __construct(private readonly AiJobRecommendationService $service)
    {
    }

    public function index(): JsonResponse
    {
        return $this->success(AiJobRecommendationResource::collection($this->service->paginate()));
    }

    public function store(StoreAiJobRecommendationRequest $request): JsonResponse
    {
        $recommendation = $this->service->create($request->validated());

        return $this->success(new AiJobRecommendationResource($recommendation), 'Recommendation created successfully.', 201);
    }

    public function show(AiJobRecommendation $aiJobRecommendation): JsonResponse
    {
        return $this->success(new AiJobRecommendationResource($aiJobRecommendation->load(['user', 'job'])));
    }

    public function update(UpdateAiJobRecommendationRequest $request, AiJobRecommendation $aiJobRecommendation): JsonResponse
    {
        $aiJobRecommendation = $this->service->update($aiJobRecommendation, $request->validated());

        return $this->success(new AiJobRecommendationResource($aiJobRecommendation), 'Recommendation updated successfully.');
    }

    public function destroy(AiJobRecommendation $aiJobRecommendation): JsonResponse
    {
        $this->service->delete($aiJobRecommendation);

        return $this->success(null, 'Recommendation deleted successfully.');
    }
}
