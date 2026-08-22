<?php

namespace App\Services;

use App\Models\JobView;

class JobViewService extends BaseCrudService
{
    protected string $model = JobView::class;

    protected array $with = ['job', 'user'];

    public function record(int $jobId, ?int $userId, string $ip): JobView
    {
        return JobView::create([
            'job_id' => $jobId,
            'user_id' => $userId,
            'ip_address' => $ip,
            'viewed_at' => now(),
        ]);
    }
}
