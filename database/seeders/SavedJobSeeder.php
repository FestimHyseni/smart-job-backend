<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\SavedJob;
use App\Models\User;
use Illuminate\Database\Seeder;

class SavedJobSeeder extends Seeder
{
    public function run(): void
    {
        $userIds = User::pluck('id')->all();
        $jobIds = Job::pluck('id')->all();

        $pairs = [];
        foreach ($userIds as $userId) {
            foreach ($jobIds as $jobId) {
                $pairs[] = [$userId, $jobId];
            }
        }
        shuffle($pairs);

        foreach (array_slice($pairs, 0, 50) as [$userId, $jobId]) {
            SavedJob::factory()->create([
                'user_id' => $userId,
                'job_id' => $jobId,
            ]);
        }
    }
}
