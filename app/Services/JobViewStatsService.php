<?php

namespace App\Services;

use App\Models\JobViewStats;

class JobViewStatsService extends BaseCrudService
{
    protected string $model = JobViewStats::class;

    protected array $with = ['job'];
}
