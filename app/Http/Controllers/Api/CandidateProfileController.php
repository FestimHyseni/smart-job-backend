<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CandidateProfile\StoreCandidateProfileRequest;
use App\Http\Requests\CandidateProfile\UpdateCandidateProfileRequest;
use App\Http\Resources\CandidateProfileResource;
use App\Models\CandidateProfile;
use App\Services\CandidateProfileService;
use Illuminate\Http\JsonResponse;

class CandidateProfileController extends Controller
{
    public function __construct(private readonly CandidateProfileService $service)
    {
    }

    public function index(): JsonResponse
    {
        return $this->success(CandidateProfileResource::collection($this->service->paginate()));
    }

    public function store(StoreCandidateProfileRequest $request): JsonResponse
    {
        $profile = $this->service->create($request->validated());

        return $this->success(new CandidateProfileResource($profile), 'Candidate profile created successfully.', 201);
    }

    public function show(CandidateProfile $candidateProfile): JsonResponse
    {
        return $this->success(new CandidateProfileResource($candidateProfile->load(['user', 'location'])));
    }

    public function update(UpdateCandidateProfileRequest $request, CandidateProfile $candidateProfile): JsonResponse
    {
        $candidateProfile = $this->service->update($candidateProfile, $request->validated());

        return $this->success(new CandidateProfileResource($candidateProfile), 'Candidate profile updated successfully.');
    }

    public function destroy(CandidateProfile $candidateProfile): JsonResponse
    {
        $this->service->delete($candidateProfile);

        return $this->success(null, 'Candidate profile deleted successfully.');
    }
}
