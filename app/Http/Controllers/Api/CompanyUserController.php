<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyUser\StoreCompanyUserRequest;
use App\Http\Requests\CompanyUser\UpdateCompanyUserRequest;
use App\Http\Resources\CompanyUserResource;
use App\Models\CompanyUser;
use App\Services\CompanyUserService;
use Illuminate\Http\JsonResponse;

class CompanyUserController extends Controller
{
    public function __construct(private readonly CompanyUserService $service)
    {
    }

    public function index(): JsonResponse
    {
        return $this->success(CompanyUserResource::collection($this->service->paginate()));
    }

    public function store(StoreCompanyUserRequest $request): JsonResponse
    {
        $companyUser = $this->service->create($request->validated());

        return $this->success(new CompanyUserResource($companyUser), 'Company member added successfully.', 201);
    }

    public function show(CompanyUser $companyUser): JsonResponse
    {
        return $this->success(new CompanyUserResource($companyUser->load(['company', 'user'])));
    }

    public function update(UpdateCompanyUserRequest $request, CompanyUser $companyUser): JsonResponse
    {
        $companyUser = $this->service->update($companyUser, $request->validated());

        return $this->success(new CompanyUserResource($companyUser), 'Company member updated successfully.');
    }

    public function destroy(CompanyUser $companyUser): JsonResponse
    {
        $this->service->delete($companyUser);

        return $this->success(null, 'Company member removed successfully.');
    }
}
