<?php

namespace Database\Factories;

use App\Enums\EmploymentType;
use App\Enums\ExperienceLevel;
use App\Enums\JobStatus;
use App\Models\Company;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Job>
 */
class JobFactory extends Factory
{
    protected $model = Job::class;

    public function definition(): array
    {
        $salaryMin = fake()->numberBetween(500, 3000);

        return [
            'company_id' => Company::factory(),
            'category_id' => JobCategory::factory(),
            'title' => fake()->jobTitle(),
            'description' => fake()->paragraphs(3, true),
            'requirements' => fake()->paragraphs(2, true),
            'location_id' => Location::factory(),
            'employment_type' => fake()->randomElement(EmploymentType::cases()),
            'experience_level' => fake()->randomElement(ExperienceLevel::cases()),
            'salary_min' => $salaryMin,
            'salary_max' => $salaryMin + fake()->numberBetween(200, 3000),
            'salary_currency' => fake()->randomElement(['EUR', 'USD', 'GBP']),
            'status' => fake()->randomElement(JobStatus::cases()),
            'deadline' => fake()->dateTimeBetween('now', '+3 months'),
        ];
    }
}
