<?php

namespace App\Services;

use App\Models\JobCategory;

class JobCategoryService extends BaseCrudService
{
    protected string $model = JobCategory::class;
}
