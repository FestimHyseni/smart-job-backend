<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->count(5)->admin()->create();
        User::factory()->count(15)->employer()->create();
        User::factory()->count(30)->candidate()->create();
    }
}
