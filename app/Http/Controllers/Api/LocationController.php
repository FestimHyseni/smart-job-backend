<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Location\StoreLocationRequest;
use App\Http\Requests\Location\UpdateLocationRequest;
use App\Http\Resources\LocationResource;
use App\Models\Location;
use App\Services\LocationService;
use Illuminate\Http\JsonResponse;

class LocationController extends Controller
{
    public function __construct(private readonly LocationService $service)
    {
    }

    public function index(): JsonResponse
    {
        return $this->success(LocationResource::collection($this->service->paginate()));
    }

    public function store(StoreLocationRequest $request): JsonResponse
    {
        $location = $this->service->create($request->validated());

        return $this->success(new LocationResource($location), 'Location created successfully.', 201);
    }

    public function show(Location $location): JsonResponse
    {
        return $this->success(new LocationResource($location));
    }

    public function update(UpdateLocationRequest $request, Location $location): JsonResponse
    {
        $location = $this->service->update($location, $request->validated());

        return $this->success(new LocationResource($location), 'Location updated successfully.');
    }

    public function destroy(Location $location): JsonResponse
    {
        $this->service->delete($location);

        return $this->success(null, 'Location deleted successfully.');
    }
}
