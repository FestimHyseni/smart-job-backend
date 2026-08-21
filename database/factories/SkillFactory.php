<?php

namespace Database\Factories;

use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Skill>
 */
class SkillFactory extends Factory
{
    protected $model = Skill::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement([
                'PHP', 'Laravel', 'Symfony', 'JavaScript', 'TypeScript', 'Vue.js',
                'React', 'Angular', 'Node.js', 'Express.js', 'Python', 'Django',
                'Flask', 'Java', 'Spring Boot', 'C#', '.NET', 'C++', 'Go', 'Rust',
                'Ruby', 'Ruby on Rails', 'Swift', 'Kotlin', 'Flutter', 'Dart',
                'MySQL', 'PostgreSQL', 'MongoDB', 'Redis', 'SQLite', 'GraphQL',
                'REST API', 'Docker', 'Kubernetes', 'AWS', 'Azure', 'Google Cloud',
                'CI/CD', 'Git', 'Linux', 'Nginx', 'HTML', 'CSS', 'Tailwind CSS',
                'Bootstrap', 'Sass', 'Webpack', 'Vite', 'Jest', 'PHPUnit',
                'Cypress', 'Selenium', 'Figma', 'Adobe XD', 'Photoshop',
                'Machine Learning', 'TensorFlow', 'PyTorch', 'Pandas', 'NumPy',
                'Elasticsearch', 'RabbitMQ', 'Kafka', 'Terraform', 'Ansible',
                'Jenkins', 'Agile/Scrum', 'JIRA',
            ]),
        ];
    }
}
