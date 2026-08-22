<?php

namespace App\Services;

use App\Models\CandidateProfile;

class CandidateProfileService extends BaseCrudService
{
    protected string $model = CandidateProfile::class;

    protected array $with = ['user', 'location'];
}
