<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resume\StoreResumeRequest;
use App\Http\Requests\Resume\UpdateResumeRequest;
use App\Http\Resources\ResumeResource;
use App\Models\Resume;
use App\Services\ResumeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class ResumeController extends Controller
{
    public function __construct(private readonly ResumeService $service)
    {
    }

    public function index(): JsonResponse
    {
        return $this->success(ResumeResource::collection($this->service->paginate()));
    }

    public function store(StoreResumeRequest $request): JsonResponse
    {
        $data = $request->validated();

        $resume = $this->service->store($data['user_id'], $request->file('file'), $data['is_default'] ?? false);

        return $this->success(new ResumeResource($resume->load('user')), 'Resume uploaded successfully.', 201);
    }

    public function show(Resume $resume): JsonResponse
    {
        return $this->success(new ResumeResource($resume->load('user')));
    }

    public function update(UpdateResumeRequest $request, Resume $resume): JsonResponse
    {
        $data = $request->validated();

        $resume = $this->service->replace($resume, $request->file('file'), $data['is_default'] ?? null);

        return $this->success(new ResumeResource($resume), 'Resume updated successfully.');
    }

    public function destroy(Resume $resume): JsonResponse
    {
        Storage::disk('public')->delete($resume->file_path);

        $this->service->delete($resume);

        return $this->success(null, 'Resume deleted successfully.');
    }
}
