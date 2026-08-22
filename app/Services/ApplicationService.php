<?php

namespace App\Services;

use App\Models\Application;

class ApplicationService extends BaseCrudService
{
    protected string $model = Application::class;

    protected array $with = ['job', 'candidate', 'resume'];

    public function create(array $data): Application
    {
        $data['applied_at'] = now();

        return parent::create($data);
    }
}
