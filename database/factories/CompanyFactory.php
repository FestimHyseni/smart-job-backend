<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Company>
 */
class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'description' => fake()->paragraph(4),
            'logo' => null,
            'website' => fake()->url(),
            'location_id' => Location::factory(),
            'industry' => fake()->randomElement([
                'Software Development', 'Marketing', 'Design', 'Finance',
                'Healthcare', 'Education', 'Retail', 'Manufacturing',
            ]),
            'employees_count' => fake()->numberBetween(5, 5000),
        ];
    }
}
