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

    public function statsForJob(int $jobId, int $days = 14): array
    {
        $since = now()->subDays($days - 1)->startOfDay();

        $countsByDate = JobView::where('job_id', $jobId)
            ->where('viewed_at', '>=', $since)
            ->selectRaw('DATE(viewed_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->pluck('count', 'date');

        $daily = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $daily[] = ['date' => $date, 'count' => (int) ($countsByDate[$date] ?? 0)];
        }

        return [
            'total' => JobView::where('job_id', $jobId)->count(),
            'daily' => $daily,
        ];
    }
}
