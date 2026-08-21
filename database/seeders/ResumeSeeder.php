<?php

namespace Database\Seeders;

use App\Models\Resume;
use App\Models\User;
use Illuminate\Database\Seeder;

class ResumeSeeder extends Seeder
{
    public function run(): void
    {
        Resume::factory()
            ->recycle(User::all())
            ->count(50)
            ->create();
    }
}
