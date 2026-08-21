<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\JobSkill;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class JobSkillSeeder extends Seeder
{
    public function run(): void
    {
        $jobIds = Job::pluck('id')->all();
        $skillIds = Skill::pluck('id')->all();

        $pairs = [];
        foreach ($jobIds as $jobId) {
            foreach ($skillIds as $skillId) {
                $pairs[] = [$jobId, $skillId];
            }
        }
        shuffle($pairs);

        foreach (array_slice($pairs, 0, 50) as [$jobId, $skillId]) {
            JobSkill::factory()->create([
                'job_id' => $jobId,
                'skill_id' => $skillId,
            ]);
        }
    }
}
