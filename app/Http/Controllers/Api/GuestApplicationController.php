<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuestApplication\StoreGuestApplicationRequest;
use App\Http\Resources\ApplicationResource;
use App\Services\GuestApplicationService;
use Illuminate\Http\JsonResponse;

class GuestApplicationController extends Controller
{
    public function __construct(private readonly GuestApplicationService $service)
    {
    }

    public function store(StoreGuestApplicationRequest $request): JsonResponse
    {
        $data = $request->validated();

        $application = $this->service->apply($data, $request->file('resume'));

        return $this->success(new ApplicationResource($application), 'Application submitted successfully.', 201);
    }
}
