<?php

namespace Database\Seeders;

use App\Models\CandidateSkill;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Seeder;

class CandidateSkillSeeder extends Seeder
{
    public function run(): void
    {
        $userIds = User::pluck('id')->all();
        $skillIds = Skill::pluck('id')->all();

        $pairs = [];
        foreach ($userIds as $userId) {
            foreach ($skillIds as $skillId) {
                $pairs[] = [$userId, $skillId];
            }
        }
        shuffle($pairs);

        foreach (array_slice($pairs, 0, 50) as [$userId, $skillId]) {
            CandidateSkill::factory()->create([
                'user_id' => $userId,
                'skill_id' => $skillId,
            ]);
        }
    }
}
