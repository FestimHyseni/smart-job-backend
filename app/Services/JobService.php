<?php

namespace App\Services;

use App\Enums\JobStatus;
use App\Enums\NotificationType;
use App\Models\Job;
use App\Notifications\NewJobFromFollowedCompany;
use Illuminate\Support\Facades\Log;
use Throwable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

class JobService extends BaseCrudService
{
    protected string $model = Job::class;

    protected array $with = ['company', 'category', 'location', 'skills'];

    public function __construct(private readonly NotificationService $notificationService) {}

    public function create(array $data): Model
    {
        /** @var Job $job */
        $job = parent::create($data);

        if ($job->status === JobStatus::Published) {
            $this->notifyFollowers($job);
        }

        return $job;
    }

    public function update(Model $record, array $data): Model
    {
        /** @var Job $job */
        $job = $record;
        $wasPublished = $job->status === JobStatus::Published;

        $job = parent::update($job, $data);

        if ($job->status === JobStatus::Published && ! $wasPublished) {
            $this->notifyFollowers($job);
        }

        return $job;
    }

    private function notifyFollowers(Job $job): void
    {
        $followers = $job->company->followers()->with('user')->get();

        foreach ($followers as $follow) {
            $userId = $follow->user_id;

            if ($follow->user) {
                try {
                    $follow->user->notify(new NewJobFromFollowedCompany($job));
                } catch (Throwable $e) {
                    Log::error('Failed to send new job email to follower.', [
                        'job_id' => $job->id,
                        'user_id' => $userId,
                        'error' => $e->getMessage(),
                    ]);
                }
            }

            $this->notificationService->notify(
                $userId,
                NotificationType::NewJobFromFollowedCompany,
                'Vend i ri pune',
                "{$job->company->name} postoi një vend të ri pune: \"{$job->title}\".",
            );
        }
    }

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
