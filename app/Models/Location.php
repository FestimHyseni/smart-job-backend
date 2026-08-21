<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'city',
        'country',
    ];

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }

    public function candidateProfiles(): HasMany
    {
        return $this->hasMany(CandidateProfile::class);
    }

    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class);
    }
}
