<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            LocationSeeder::class,
            CompanySeeder::class,
            CompanyUserSeeder::class,
            CandidateProfileSeeder::class,
            JobCategorySeeder::class,
            JobSeeder::class,
            SkillSeeder::class,
            JobSkillSeeder::class,
            CandidateSkillSeeder::class,
            ResumeSeeder::class,
            ApplicationSeeder::class,
            EducationSeeder::class,
            ExperienceSeeder::class,
            SavedJobSeeder::class,
            JobViewSeeder::class,
            JobViewStatsSeeder::class,
            NotificationSeeder::class,
            ConversationSeeder::class,
            ConversationParticipantSeeder::class,
            MessageSeeder::class,
            InterviewSeeder::class,
            AiJobRecommendationSeeder::class,
        ]);
    }
}
