<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\CompanyUser;
use App\Models\User;
use Illuminate\Database\Seeder;

class CompanyUserSeeder extends Seeder
{
    public function run(): void
    {
        $companyIds = Company::pluck('id')->all();
        $userIds = User::pluck('id')->all();

        $pairs = [];
        foreach ($companyIds as $companyId) {
            foreach ($userIds as $userId) {
                $pairs[] = [$companyId, $userId];
            }
        }
        shuffle($pairs);

        foreach (array_slice($pairs, 0, 50) as [$companyId, $userId]) {
            CompanyUser::factory()->create([
                'company_id' => $companyId,
                'user_id' => $userId,
            ]);
        }
    }
}
