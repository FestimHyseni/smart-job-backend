<?php

namespace App\Services;

use App\Models\Company;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CompanyService extends BaseCrudService
{
    protected string $model = Company::class;

    protected array $with = ['location'];

    public function updateLogo(Company $company, UploadedFile $file): Company
    {
        if ($company->logo) {
            Storage::disk('public')->delete($company->logo);
        }

        $company->logo = $file->store('company-logos', 'public');
        $company->save();

        return $company->fresh($this->with);
    }
}
