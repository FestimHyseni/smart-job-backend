<?php

namespace App\Services;

use App\Models\CompanyUser;

class CompanyUserService extends BaseCrudService
{
    protected string $model = CompanyUser::class;

    protected array $with = ['company.location', 'user'];
}
