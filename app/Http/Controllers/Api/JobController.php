<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Job\StoreJobRequest;
use App\Http\Requests\Job\UpdateJobRequest;
use App\Http\Resources\JobResource;
use App\Models\Job;
use App\Services\JobService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function __construct(private readonly JobService $service)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $jobs = $this->service->search($request->only([
            'status', 'category_id', 'location_id', 'employment_type', 'experience_level', 'search', 'sort', 'company_id',
        ]));

        return $this->success(JobResource::collection($jobs));
    }

    public function store(StoreJobRequest $request): JsonResponse
    {
        $job = $this->service->create($request->validated());

        return $this->success(new JobResource($job), 'Job created successfully.', 201);
    }

    public function show(Job $job): JsonResponse
    {
        return $this->success(new JobResource($job->load(['company', 'category', 'location', 'skills'])));
    }

    public function update(UpdateJobRequest $request, Job $job): JsonResponse
    {
        $job = $this->service->update($job, $request->validated());

        return $this->success(new JobResource($job), 'Job updated successfully.');
    }

    public function destroy(Job $job): JsonResponse
    {
        $this->service->delete($job);

        return $this->success(null, 'Job deleted successfully.');
    }
}
