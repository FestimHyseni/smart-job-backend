<?php

namespace App\Services;

use App\Models\Resume;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ResumeService extends BaseCrudService
{
    protected string $model = Resume::class;

    protected array $with = ['user'];

    public function store(int $userId, UploadedFile $file, bool $isDefault = false): Resume
    {
        $path = $file->store('resumes', 'public');

        if ($isDefault) {
            Resume::where('user_id', $userId)->update(['is_default' => false]);
        }

        return Resume::create([
            'user_id' => $userId,
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $path,
            'is_default' => $isDefault,
        ]);
    }

    public function replace(Resume $resume, ?UploadedFile $file, ?bool $isDefault): Resume
    {
        if ($file) {
            Storage::disk('public')->delete($resume->file_path);
            $resume->file_path = $file->store('resumes', 'public');
            $resume->file_name = $file->getClientOriginalName();
        }

        if ($isDefault) {
            Resume::where('user_id', $resume->user_id)->where('id', '!=', $resume->id)->update(['is_default' => false]);
            $resume->is_default = true;
        } elseif ($isDefault === false) {
            $resume->is_default = false;
        }

        $resume->save();

        return $resume->fresh($this->with);
    }
}
