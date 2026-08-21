<?php

namespace App\Models;

use App\Enums\InterviewStatus;
use App\Enums\InterviewType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Interview extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'scheduled_at',
        'type',
        'location',
        'meeting_url',
        'notes',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'scheduled_at' => 'datetime',
            'type' => InterviewType::class,
            'status' => InterviewStatus::class,
        ];
    }

    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }

    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->where('status', InterviewStatus::Scheduled)
            ->where('scheduled_at', '>=', now());
    }

    public function scopeStatus(Builder $query, InterviewStatus $status): Builder
    {
        return $query->where('status', $status);
    }
}
