<?php

namespace App\Services;

use App\Enums\JobStatus;
use App\Models\Job;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class JobService extends BaseCrudService
{
    protected string $model = Job::class;

    protected array $with = ['company', 'category', 'location', 'skills'];

    public function search(array $filters, int $perPage = 15): LengthAwarePaginator
    {
        $query = Job::query()->with($this->with);

        $query->when($filters['status'] ?? null, fn ($q, $status) => $q->where('status', $status))
            ->when(! isset($filters['status']), fn ($q) => $q->where('status', JobStatus::Published))
            ->when($filters['company_id'] ?? null, fn ($q, $companyId) => $q->where('company_id', $companyId))
            ->when($filters['category_id'] ?? null, fn ($q, $categoryId) => $q->where('category_id', $categoryId))
            ->when($filters['location_id'] ?? null, fn ($q, $locationId) => $q->where('location_id', $locationId))
            ->when($filters['employment_type'] ?? null, fn ($q, $type) => $q->where('employment_type', $type))
            ->when($filters['experience_level'] ?? null, fn ($q, $level) => $q->where('experience_level', $level))
            ->when($filters['search'] ?? null, fn ($q, $search) => $q->where('title', 'like', "%{$search}%"));

        $sort = $filters['sort'] ?? '-created_at';
        $direction = str_starts_with($sort, '-') ? 'desc' : 'asc';
        $column = ltrim($sort, '-');

        if (in_array($column, ['created_at', 'deadline', 'salary_min', 'salary_max'], true)) {
            $query->orderBy($column, $direction);
        } else {
            $query->latest();
        }

        return $query->paginate($perPage)->withQueryString();
    }
}
