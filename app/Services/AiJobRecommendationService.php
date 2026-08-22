<?php

namespace App\Services;

use App\Models\AiJobRecommendation;

class AiJobRecommendationService extends BaseCrudService
{
    protected string $model = AiJobRecommendation::class;

    protected array $with = ['user', 'job'];
}
