<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CandidateSkill\StoreCandidateSkillRequest;
use App\Http\Requests\CandidateSkill\UpdateCandidateSkillRequest;
use App\Http\Resources\CandidateSkillResource;
use App\Models\CandidateSkill;
use App\Services\CandidateSkillService;
use Illuminate\Http\JsonResponse;

class CandidateSkillController extends Controller
{
    public function __construct(private readonly CandidateSkillService $service)
    {
    }

    public function index(): JsonResponse
    {
        return $this->success(CandidateSkillResource::collection($this->service->paginate()));
    }

    public function store(StoreCandidateSkillRequest $request): JsonResponse
    {
        $candidateSkill = $this->service->create($request->validated());

        return $this->success(new CandidateSkillResource($candidateSkill), 'Candidate skill added successfully.', 201);
    }

    public function show(CandidateSkill $candidateSkill): JsonResponse
    {
        return $this->success(new CandidateSkillResource($candidateSkill->load(['user', 'skill'])));
    }

    public function update(UpdateCandidateSkillRequest $request, CandidateSkill $candidateSkill): JsonResponse
    {
        $candidateSkill = $this->service->update($candidateSkill, $request->validated());

        return $this->success(new CandidateSkillResource($candidateSkill), 'Candidate skill updated successfully.');
    }

    public function destroy(CandidateSkill $candidateSkill): JsonResponse
    {
        $this->service->delete($candidateSkill);

        return $this->success(null, 'Candidate skill removed successfully.');
    }
}
