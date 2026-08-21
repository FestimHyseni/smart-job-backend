<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Job;
use App\Models\Resume;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    public function run(): void
    {
        $jobIds = Job::pluck('id')->all();
        $resumes = Resume::all(['id', 'user_id']);

        for ($i = 0; $i < 50; $i++) {
            $resume = $resumes->random();

            Application::factory()->create([
                'job_id' => fake()->randomElement($jobIds),
                'candidate_id' => $resume->user_id,
                'resume_id' => $resume->id,
            ]);
        }
    }
}
