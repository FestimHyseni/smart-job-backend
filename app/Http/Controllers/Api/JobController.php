<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Job\StoreJobRequest;
use App\Http\Requests\Job\UpdateJobRequest;
use App\Http\Resources\JobResource;
use App\Models\Job;
use App\Services\JobService;
use App\Services\JobViewService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function __construct(
        private readonly JobService $service,
        private readonly JobViewService $jobViewService,
    ) {
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

    public function show(Request $request, Job $job): JsonResponse
    {
        $job->load(['company', 'category', 'location', 'skills']);

        $viewerId = $request->user('sanctum')?->id;
        $isOwnJob = $viewerId && $job->company->users()->where('user_id', $viewerId)->exists();
        if (! $isOwnJob) {
            $this->jobViewService->record($job->id, $viewerId, $request->ip());
        }

        return $this->success(new JobResource($job));
    }

    public function viewStats(Request $request, Job $job): JsonResponse
    {
        $isOwnJob = $job->company->users()->where('user_id', $request->user()->id)->exists();
        abort_unless($isOwnJob, 403);

        return $this->success($this->jobViewService->statsForJob($job->id));
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
