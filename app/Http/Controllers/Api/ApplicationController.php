<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Application\StoreApplicationRequest;
use App\Http\Requests\Application\UpdateApplicationRequest;
use App\Http\Resources\ApplicationResource;
use App\Models\Application;
use App\Services\ApplicationService;
use Illuminate\Http\JsonResponse;

class ApplicationController extends Controller
{
    public function __construct(private readonly ApplicationService $service)
    {
    }

    public function index(): JsonResponse
    {
        return $this->success(ApplicationResource::collection($this->service->paginate()));
    }

    public function store(StoreApplicationRequest $request): JsonResponse
    {
        $application = $this->service->create($request->validated());

        return $this->success(new ApplicationResource($application), 'Application submitted successfully.', 201);
    }

    public function show(Application $application): JsonResponse
    {
        return $this->success(new ApplicationResource($application->load(['job', 'candidate', 'resume', 'interviews'])));
    }

    public function update(UpdateApplicationRequest $request, Application $application): JsonResponse
    {
        $application = $this->service->update($application, $request->validated());

        return $this->success(new ApplicationResource($application), 'Application updated successfully.');
    }

    public function destroy(Application $application): JsonResponse
    {
        $this->service->delete($application);

        return $this->success(null, 'Application withdrawn successfully.');
    }
}
