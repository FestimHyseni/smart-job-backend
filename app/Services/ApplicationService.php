<?php

namespace App\Services;

use App\Models\Application;
use App\Models\CompanyUser;
use App\Notifications\ApplicationStatusUpdated;
use App\Notifications\ApplicationSubmitted;
use App\Notifications\NewApplicationReceived;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Throwable;

class ApplicationService extends BaseCrudService
{
    protected string $model = Application::class;

    protected array $with = ['job.company', 'job.location', 'candidate', 'resume', 'interviews'];

    public function create(array $data): Application
    {
        $data['applied_at'] = now();

        $application = parent::create($data);

        $this->notifySafely($application, new ApplicationSubmitted($application), 'Failed to send application confirmation email.');
        $this->notifyEmployers($application);

        return $application;
    }

    public function update(Model $record, array $data): Application
    {
        $previousStatus = $record->status;

        /** @var Application $application */
        $application = parent::update($record, $data);

        if (isset($data['status']) && $application->status !== $previousStatus) {
            $this->notifySafely($application, new ApplicationStatusUpdated($application), 'Failed to send application status update email.');
        }

        return $application;
    }

    public function search(array $filters, int $perPage = 15): LengthAwarePaginator
    {
        $query = Application::query()->with($this->with);

        $query->when($filters['candidate_id'] ?? null, fn ($q, $candidateId) => $q->where('candidate_id', $candidateId))
            ->when($filters['job_id'] ?? null, fn ($q, $jobId) => $q->where('job_id', $jobId))
            ->when($filters['status'] ?? null, fn ($q, $status) => $q->where('status', $status));

        return $query->latest()->paginate($perPage)->withQueryString();
    }

    private function notifySafely(Application $application, mixed $notification, string $logMessage): void
    {
        try {
            $application->candidate->notify($notification);
        } catch (Throwable $e) {
            Log::error($logMessage, [
                'application_id' => $application->id,
                'error' => $e->getMessage(),
            ]);
        }
    }

    private function notifyEmployers(Application $application): void
    {
        $companyId = $application->job->company_id;
        $employers = CompanyUser::with('user')->where('company_id', $companyId)->get()->pluck('user')->filter();

        foreach ($employers as $employer) {
            try {
                $employer->notify(new NewApplicationReceived($application));
            } catch (Throwable $e) {
                Log::error('Failed to send new application email to employer.', [
                    'application_id' => $application->id,
                    'employer_id' => $employer->id,
                    'error' => $e->getMessage(),
                ]);
            }
        }
    }
}
