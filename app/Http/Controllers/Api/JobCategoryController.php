<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobCategory\StoreJobCategoryRequest;
use App\Http\Requests\JobCategory\UpdateJobCategoryRequest;
use App\Http\Resources\JobCategoryResource;
use App\Models\JobCategory;
use App\Services\JobCategoryService;
use Illuminate\Http\JsonResponse;

class JobCategoryController extends Controller
{
    public function __construct(private readonly JobCategoryService $service)
    {
    }

    public function index(): JsonResponse
    {
        return $this->success(JobCategoryResource::collection($this->service->paginate()));
    }

    public function store(StoreJobCategoryRequest $request): JsonResponse
    {
        $category = $this->service->create($request->validated());

        return $this->success(new JobCategoryResource($category), 'Job category created successfully.', 201);
    }

    public function show(JobCategory $jobCategory): JsonResponse
    {
        return $this->success(new JobCategoryResource($jobCategory));
    }

    public function update(UpdateJobCategoryRequest $request, JobCategory $jobCategory): JsonResponse
    {
        $jobCategory = $this->service->update($jobCategory, $request->validated());

        return $this->success(new JobCategoryResource($jobCategory), 'Job category updated successfully.');
    }

    public function destroy(JobCategory $jobCategory): JsonResponse
    {
        $this->service->delete($jobCategory);

        return $this->success(null, 'Job category deleted successfully.');
    }
}
