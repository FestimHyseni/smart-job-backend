<?php

namespace App\Models;

use App\Enums\RecommendationStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AiJobRecommendation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_id',
        'match_score',
        'reason',
        'model_version',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'match_score' => 'decimal:2',
            'status' => RecommendationStatus::class,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }
}
