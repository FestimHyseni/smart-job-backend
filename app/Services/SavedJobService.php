<?php

namespace App\Services;

use App\Models\SavedJob;

class SavedJobService extends BaseCrudService
{
    protected string $model = SavedJob::class;

    protected array $with = ['user', 'job'];
}
