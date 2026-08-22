<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Skill\StoreSkillRequest;
use App\Http\Requests\Skill\UpdateSkillRequest;
use App\Http\Resources\SkillResource;
use App\Models\Skill;
use App\Services\SkillService;
use Illuminate\Http\JsonResponse;

class SkillController extends Controller
{
    public function __construct(private readonly SkillService $service)
    {
    }

    public function index(): JsonResponse
    {
        return $this->success(SkillResource::collection($this->service->paginate()));
    }

    public function store(StoreSkillRequest $request): JsonResponse
    {
        $skill = $this->service->create($request->validated());

        return $this->success(new SkillResource($skill), 'Skill created successfully.', 201);
    }

    public function show(Skill $skill): JsonResponse
    {
        return $this->success(new SkillResource($skill));
    }

    public function update(UpdateSkillRequest $request, Skill $skill): JsonResponse
    {
        $skill = $this->service->update($skill, $request->validated());

        return $this->success(new SkillResource($skill), 'Skill updated successfully.');
    }

    public function destroy(Skill $skill): JsonResponse
    {
        $this->service->delete($skill);

        return $this->success(null, 'Skill deleted successfully.');
    }
}
