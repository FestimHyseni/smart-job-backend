<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Experience\StoreExperienceRequest;
use App\Http\Requests\Experience\UpdateExperienceRequest;
use App\Http\Resources\ExperienceResource;
use App\Models\Experience;
use App\Services\ExperienceService;
use Illuminate\Http\JsonResponse;

class ExperienceController extends Controller
{
    public function __construct(private readonly ExperienceService $service)
    {
    }

    public function index(): JsonResponse
    {
        return $this->success(ExperienceResource::collection($this->service->paginate()));
    }

    public function store(StoreExperienceRequest $request): JsonResponse
    {
        $experience = $this->service->create($request->validated());

        return $this->success(new ExperienceResource($experience), 'Experience added successfully.', 201);
    }

    public function show(Experience $experience): JsonResponse
    {
        return $this->success(new ExperienceResource($experience->load('user')));
    }

    public function update(UpdateExperienceRequest $request, Experience $experience): JsonResponse
    {
        $experience = $this->service->update($experience, $request->validated());

        return $this->success(new ExperienceResource($experience), 'Experience updated successfully.');
    }

    public function destroy(Experience $experience): JsonResponse
    {
        $this->service->delete($experience);

        return $this->success(null, 'Experience removed successfully.');
    }
}
