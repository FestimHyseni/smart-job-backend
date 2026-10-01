<?php

namespace App\Services;

use App\Models\CompanyFollow;

class CompanyFollowService extends BaseCrudService
{
    protected string $model = CompanyFollow::class;

    protected array $with = ['user', 'company.location'];
}
