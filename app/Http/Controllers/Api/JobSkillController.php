<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobSkill\StoreJobSkillRequest;
use App\Http\Requests\JobSkill\UpdateJobSkillRequest;
use App\Http\Resources\JobSkillResource;
use App\Models\JobSkill;
use App\Services\JobSkillService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JobSkillController extends Controller
{
    public function __construct(private readonly JobSkillService $service)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $perPage = min((int) $request->integer('per_page', 15), 200);

        return $this->success(JobSkillResource::collection($this->service->paginate($perPage)));
    }

    public function store(StoreJobSkillRequest $request): JsonResponse
    {
        $jobSkill = $this->service->create($request->validated());

        return $this->success(new JobSkillResource($jobSkill), 'Job skill added successfully.', 201);
    }

    public function show(JobSkill $jobSkill): JsonResponse
    {
        return $this->success(new JobSkillResource($jobSkill->load(['job', 'skill'])));
    }

    public function update(UpdateJobSkillRequest $request, JobSkill $jobSkill): JsonResponse
    {
        $jobSkill = $this->service->update($jobSkill, $request->validated());

        return $this->success(new JobSkillResource($jobSkill), 'Job skill updated successfully.');
    }

    public function destroy(JobSkill $jobSkill): JsonResponse
    {
        $this->service->delete($jobSkill);

        return $this->success(null, 'Job skill removed successfully.');
    }
}
