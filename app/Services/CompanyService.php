<?php

namespace App\Services;

use App\Models\Company;

class CompanyService extends BaseCrudService
{
    protected string $model = Company::class;

    protected array $with = ['location'];
}
