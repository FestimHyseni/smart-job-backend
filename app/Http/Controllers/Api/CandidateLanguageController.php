<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CandidateLanguage\StoreCandidateLanguageRequest;
use App\Http\Requests\CandidateLanguage\UpdateCandidateLanguageRequest;
use App\Http\Resources\CandidateLanguageResource;
use App\Models\CandidateLanguage;
use App\Services\CandidateLanguageService;
use Illuminate\Http\JsonResponse;

class CandidateLanguageController extends Controller
{
    public function __construct(private readonly CandidateLanguageService $service)
    {
    }

    public function index(): JsonResponse
    {
        return $this->success(CandidateLanguageResource::collection($this->service->paginate()));
    }

    public function store(StoreCandidateLanguageRequest $request): JsonResponse
    {
        $language = $this->service->create($request->validated());

        return $this->success(new CandidateLanguageResource($language), 'Language added successfully.', 201);
    }

    public function show(CandidateLanguage $candidateLanguage): JsonResponse
    {
        return $this->success(new CandidateLanguageResource($candidateLanguage));
    }

    public function update(UpdateCandidateLanguageRequest $request, CandidateLanguage $candidateLanguage): JsonResponse
    {
        $candidateLanguage = $this->service->update($candidateLanguage, $request->validated());

        return $this->success(new CandidateLanguageResource($candidateLanguage), 'Language updated successfully.');
    }

    public function destroy(CandidateLanguage $candidateLanguage): JsonResponse
    {
        $this->service->delete($candidateLanguage);

        return $this->success(null, 'Language removed successfully.');
    }
}
