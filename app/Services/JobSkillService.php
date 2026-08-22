<?php

namespace App\Services;

use App\Models\JobSkill;

class JobSkillService extends BaseCrudService
{
    protected string $model = JobSkill::class;

    protected array $with = ['job', 'skill'];
}
