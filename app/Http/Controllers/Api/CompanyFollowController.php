<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyFollow\StoreCompanyFollowRequest;
use App\Http\Resources\CompanyFollowResource;
use App\Models\CompanyFollow;
use App\Services\CompanyFollowService;
use Illuminate\Http\JsonResponse;

class CompanyFollowController extends Controller
{
    public function __construct(private readonly CompanyFollowService $service) {}

    public function index(): JsonResponse
    {
        return $this->success(CompanyFollowResource::collection($this->service->paginate()));
    }

    public function store(StoreCompanyFollowRequest $request): JsonResponse
    {
        $companyFollow = $this->service->create($request->validated());

        return $this->success(new CompanyFollowResource($companyFollow), 'Company followed successfully.', 201);
    }

    public function show(CompanyFollow $companyFollow): JsonResponse
    {
        return $this->success(new CompanyFollowResource($companyFollow->load(['user', 'company'])));
    }

    public function destroy(CompanyFollow $companyFollow): JsonResponse
    {
        $this->service->delete($companyFollow);

        return $this->success(null, 'Company unfollowed successfully.');
    }
}
