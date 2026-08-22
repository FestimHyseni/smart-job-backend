<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobViewStats\StoreJobViewStatsRequest;
use App\Http\Requests\JobViewStats\UpdateJobViewStatsRequest;
use App\Http\Resources\JobViewStatsResource;
use App\Models\JobViewStats;
use App\Services\JobViewStatsService;
use Illuminate\Http\JsonResponse;

class JobViewStatsController extends Controller
{
    public function __construct(private readonly JobViewStatsService $service)
    {
    }

    public function index(): JsonResponse
    {
        return $this->success(JobViewStatsResource::collection($this->service->paginate()));
    }

    public function store(StoreJobViewStatsRequest $request): JsonResponse
    {
        $stats = $this->service->create($request->validated());

        return $this->success(new JobViewStatsResource($stats), 'Job view stats created successfully.', 201);
    }

    public function show(JobViewStats $jobViewStat): JsonResponse
    {
        return $this->success(new JobViewStatsResource($jobViewStat->load('job')));
    }

    public function update(UpdateJobViewStatsRequest $request, JobViewStats $jobViewStat): JsonResponse
    {
        $jobViewStat = $this->service->update($jobViewStat, $request->validated());

        return $this->success(new JobViewStatsResource($jobViewStat), 'Job view stats updated successfully.');
    }

    public function destroy(JobViewStats $jobViewStat): JsonResponse
    {
        $this->service->delete($jobViewStat);

        return $this->success(null, 'Job view stats deleted successfully.');
    }
}
