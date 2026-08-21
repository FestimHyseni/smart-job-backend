<?php

namespace Database\Factories;

use App\Models\Resume;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Resume>
 */
class ResumeFactory extends Factory
{
    protected $model = Resume::class;

    public function definition(): array
    {
        $fileName = fake()->slug(3) . '-cv.pdf';

        return [
            'user_id' => User::factory(),
            'file_name' => $fileName,
            'file_path' => 'resumes/' . $fileName,
            'is_default' => fake()->boolean(20),
        ];
    }
}
