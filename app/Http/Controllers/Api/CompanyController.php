<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\StoreCompanyRequest;
use App\Http\Requests\Company\UpdateCompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Http\JsonResponse;

class CompanyController extends Controller
{
    public function __construct(private readonly CompanyService $service)
    {
    }

    public function index(): JsonResponse
    {
        return $this->success(CompanyResource::collection($this->service->paginate()));
    }

    public function store(StoreCompanyRequest $request): JsonResponse
    {
        $company = $this->service->create($request->validated());

        return $this->success(new CompanyResource($company), 'Company created successfully.', 201);
    }

    public function show(Company $company): JsonResponse
    {
        return $this->success(new CompanyResource($company->load('location')));
    }

    public function update(UpdateCompanyRequest $request, Company $company): JsonResponse
    {
        $company = $this->service->update($company, $request->validated());

        return $this->success(new CompanyResource($company), 'Company updated successfully.');
    }

    public function destroy(Company $company): JsonResponse
    {
        $this->service->delete($company);

        return $this->success(null, 'Company deleted successfully.');
    }
}
