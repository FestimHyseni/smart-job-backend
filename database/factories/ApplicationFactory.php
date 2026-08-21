<?php

namespace Database\Factories;

use App\Enums\ApplicationStatus;
use App\Models\Application;
use App\Models\Job;
use App\Models\Resume;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Application>
 */
class ApplicationFactory extends Factory
{
    protected $model = Application::class;

    public function definition(): array
    {
        return [
            'job_id' => Job::factory(),
            'candidate_id' => User::factory(),
            'resume_id' => Resume::factory(),
            'cover_letter' => fake()->paragraph(3),
            'status' => fake()->randomElement(ApplicationStatus::cases()),
            'applied_at' => fake()->dateTimeBetween('-2 months', 'now'),
        ];
    }
}
