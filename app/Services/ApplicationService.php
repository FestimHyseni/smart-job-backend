<?php

namespace App\Services;

use App\Models\Application;
use App\Notifications\ApplicationSubmitted;

class ApplicationService extends BaseCrudService
{
    protected string $model = Application::class;

    protected array $with = ['job', 'candidate', 'resume'];

    public function create(array $data): Application
    {
        $data['applied_at'] = now();

        $application = parent::create($data);

        $application->candidate->notify(new ApplicationSubmitted($application));

        return $application;
    }
}
