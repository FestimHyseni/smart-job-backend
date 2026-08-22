<?php

namespace App\Services;

use App\Models\Experience;

class ExperienceService extends BaseCrudService
{
    protected string $model = Experience::class;

    protected array $with = ['user'];
}
