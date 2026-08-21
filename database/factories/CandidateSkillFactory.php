<?php

namespace Database\Factories;

use App\Enums\SkillLevel;
use App\Models\CandidateSkill;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CandidateSkill>
 */
class CandidateSkillFactory extends Factory
{
    protected $model = CandidateSkill::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'skill_id' => Skill::factory(),
            'level' => fake()->randomElement(SkillLevel::cases()),
            'verified' => fake()->boolean(30),
        ];
    }
}
