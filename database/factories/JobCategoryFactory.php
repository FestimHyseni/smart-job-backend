<?php

namespace Database\Factories;

use App\Models\JobCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<JobCategory>
 */
class JobCategoryFactory extends Factory
{
    protected $model = JobCategory::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement([
                'Software Development', 'Web Development', 'Mobile Development',
                'Data Science', 'DevOps', 'Quality Assurance', 'UI/UX Design',
                'Product Management', 'Marketing', 'Sales', 'Customer Support',
                'Human Resources', 'Finance & Accounting', 'Cybersecurity',
                'Network Administration', 'Cloud Engineering', 'Machine Learning',
                'Business Analysis', 'Project Management', 'Content Writing',
                'Frontend Development', 'Backend Development', 'Full Stack Development',
                'iOS Development', 'Android Development', 'Embedded Systems',
                'Game Development', 'Technical Writing', 'Recruitment', 'Legal',
                'Operations', 'Supply Chain', 'Manufacturing Engineering',
                'Renewable Energy', 'Biotechnology', 'Pharmaceuticals', 'Real Estate',
                'Hospitality', 'Logistics', 'Public Relations', 'Graphic Design',
                'Video Production', 'Animation', 'Localization', 'Compliance',
                'Risk Management', 'Procurement', 'Facilities Management',
                'Event Management', 'E-commerce', 'SEO & Growth Marketing',
                'Community Management', 'Technical Support',
                'Site Reliability Engineering', 'Database Administration',
                'Blockchain Development', 'AR/VR Development', 'Robotics',
                'Firmware Engineering', 'Solutions Architecture',
                'Enterprise Architecture', 'IT Audit', 'Investment Banking',
                'Insurance', 'AgriTech', 'EdTech', 'HealthTech', 'FinTech',
            ]),
        ];
    }
}
