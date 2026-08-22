<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Interview\StoreInterviewRequest;
use App\Http\Requests\Interview\UpdateInterviewRequest;
use App\Http\Resources\InterviewResource;
use App\Models\Interview;
use App\Services\InterviewService;
use Illuminate\Http\JsonResponse;

class InterviewController extends Controller
{
    public function __construct(private readonly InterviewService $service)
    {
    }

    public function index(): JsonResponse
    {
        return $this->success(InterviewResource::collection($this->service->paginate()));
    }

    public function store(StoreInterviewRequest $request): JsonResponse
    {
        $interview = $this->service->create($request->validated());

        return $this->success(new InterviewResource($interview), 'Interview scheduled successfully.', 201);
    }

    public function show(Interview $interview): JsonResponse
    {
        return $this->success(new InterviewResource($interview->load('application')));
    }

    public function update(UpdateInterviewRequest $request, Interview $interview): JsonResponse
    {
        $interview = $this->service->update($interview, $request->validated());

        return $this->success(new InterviewResource($interview), 'Interview updated successfully.');
    }

    public function destroy(Interview $interview): JsonResponse
    {
        $this->service->delete($interview);

        return $this->success(null, 'Interview cancelled successfully.');
    }
}
