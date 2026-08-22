<?php

namespace App\Services;

use App\Models\Interview;

class InterviewService extends BaseCrudService
{
    protected string $model = Interview::class;

    protected array $with = ['application'];
}
