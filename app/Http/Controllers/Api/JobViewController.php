<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobView\StoreJobViewRequest;
use App\Http\Resources\JobViewResource;
use App\Models\JobView;
use App\Services\JobViewService;
use Illuminate\Http\JsonResponse;

class JobViewController extends Controller
{
    public function __construct(private readonly JobViewService $service)
    {
    }

    public function index(): JsonResponse
    {
        return $this->success(JobViewResource::collection($this->service->paginate()));
    }

    public function store(StoreJobViewRequest $request): JsonResponse
    {
        $data = $request->validated();

        $jobView = $this->service->record($data['job_id'], $data['user_id'] ?? null, $request->ip());

        return $this->success(new JobViewResource($jobView->load(['job', 'user'])), 'View recorded successfully.', 201);
    }

    public function show(JobView $jobView): JsonResponse
    {
        return $this->success(new JobViewResource($jobView->load(['job', 'user'])));
    }

    public function destroy(JobView $jobView): JsonResponse
    {
        $this->service->delete($jobView);

        return $this->success(null, 'Job view deleted successfully.');
    }
}
