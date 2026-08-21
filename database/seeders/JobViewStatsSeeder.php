<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\JobViewStats;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class JobViewStatsSeeder extends Seeder
{
    public function run(): void
    {
        $jobIds = Job::pluck('id')->all();
        $dates = collect(range(0, 59))
            ->map(fn (int $daysAgo) => Carbon::now()->subDays($daysAgo)->format('Y-m-d'))
            ->all();

        $pairs = [];
        foreach ($jobIds as $jobId) {
            foreach ($dates as $date) {
                $pairs[] = [$jobId, $date];
            }
        }
        shuffle($pairs);

        foreach (array_slice($pairs, 0, 50) as [$jobId, $date]) {
            JobViewStats::factory()->create([
                'job_id' => $jobId,
                'date' => $date,
            ]);
        }
    }
}
