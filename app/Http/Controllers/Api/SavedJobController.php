<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SavedJob\StoreSavedJobRequest;
use App\Http\Resources\SavedJobResource;
use App\Models\SavedJob;
use App\Services\SavedJobService;
use Illuminate\Http\JsonResponse;

class SavedJobController extends Controller
{
    public function __construct(private readonly SavedJobService $service)
    {
    }

    public function index(): JsonResponse
    {
        return $this->success(SavedJobResource::collection($this->service->paginate()));
    }

    public function store(StoreSavedJobRequest $request): JsonResponse
    {
        $savedJob = $this->service->create($request->validated());

        return $this->success(new SavedJobResource($savedJob), 'Job saved successfully.', 201);
    }

    public function show(SavedJob $savedJob): JsonResponse
    {
        return $this->success(new SavedJobResource($savedJob->load(['user', 'job'])));
    }

    public function destroy(SavedJob $savedJob): JsonResponse
    {
        $this->service->delete($savedJob);

        return $this->success(null, 'Job unsaved successfully.');
    }
}
