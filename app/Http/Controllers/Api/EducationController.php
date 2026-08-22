<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Education\StoreEducationRequest;
use App\Http\Requests\Education\UpdateEducationRequest;
use App\Http\Resources\EducationResource;
use App\Models\Education;
use App\Services\EducationService;
use Illuminate\Http\JsonResponse;

class EducationController extends Controller
{
    public function __construct(private readonly EducationService $service)
    {
    }

    public function index(): JsonResponse
    {
        return $this->success(EducationResource::collection($this->service->paginate()));
    }

    public function store(StoreEducationRequest $request): JsonResponse
    {
        $education = $this->service->create($request->validated());

        return $this->success(new EducationResource($education), 'Education added successfully.', 201);
    }

    public function show(Education $education): JsonResponse
    {
        return $this->success(new EducationResource($education->load('user')));
    }

    public function update(UpdateEducationRequest $request, Education $education): JsonResponse
    {
        $education = $this->service->update($education, $request->validated());

        return $this->success(new EducationResource($education), 'Education updated successfully.');
    }

    public function destroy(Education $education): JsonResponse
    {
        $this->service->delete($education);

        return $this->success(null, 'Education removed successfully.');
    }
}
