<?php

namespace App\Services;

use App\Models\CandidateSkill;

class CandidateSkillService extends BaseCrudService
{
    protected string $model = CandidateSkill::class;

    protected array $with = ['user', 'skill'];
}
