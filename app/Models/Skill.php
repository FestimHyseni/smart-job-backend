<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function jobSkills(): HasMany
    {
        return $this->hasMany(JobSkill::class);
    }

    public function candidateSkills(): HasMany
    {
        return $this->hasMany(CandidateSkill::class);
    }

    public function jobs(): BelongsToMany
    {
        return $this->belongsToMany(Job::class, 'job_skills')
            ->as('job_skill')
            ->withPivot('importance')
            ->withTimestamps();
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'candidate_skills')
            ->as('candidate_skill')
            ->withPivot('level', 'verified')
            ->withTimestamps();
    }
}
