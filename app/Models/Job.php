<?php

namespace App\Models;

use App\Enums\EmploymentType;
use App\Enums\ExperienceLevel;
use App\Enums\JobStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'category_id',
        'title',
        'description',
        'requirements',
        'location_id',
        'employment_type',
        'experience_level',
        'salary_min',
        'salary_max',
        'salary_currency',
        'status',
        'deadline',
    ];

    protected function casts(): array
    {
        return [
            'employment_type' => EmploymentType::class,
            'experience_level' => ExperienceLevel::class,
            'status' => JobStatus::class,
            'salary_min' => 'decimal:2',
            'salary_max' => 'decimal:2',
            'deadline' => 'date',
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(JobCategory::class, 'category_id');
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function jobSkills(): HasMany
    {
        return $this->hasMany(JobSkill::class);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    public function savedByUsers(): HasMany
    {
        return $this->hasMany(SavedJob::class);
    }

    public function views(): HasMany
    {
        return $this->hasMany(JobView::class);
    }

    public function viewStats(): HasMany
    {
        return $this->hasMany(JobViewStats::class);
    }

    public function aiJobRecommendations(): HasMany
    {
        return $this->hasMany(AiJobRecommendation::class);
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'job_skills')
            ->as('job_skill')
            ->withPivot('importance')
            ->withTimestamps();
    }

    public function savedByCandidates(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'saved_jobs')
            ->withPivot('created_at');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', JobStatus::Published);
    }

    public function scopeInLocation(Builder $query, int $locationId): Builder
    {
        return $query->where('location_id', $locationId);
    }

    public function scopeOfEmploymentType(Builder $query, EmploymentType $type): Builder
    {
        return $query->where('employment_type', $type);
    }
}
