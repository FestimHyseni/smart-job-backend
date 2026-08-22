<?php

namespace App\Services;

use App\Models\Education;

class EducationService extends BaseCrudService
{
    protected string $model = Education::class;

    protected array $with = ['user'];
}
