<?php

namespace App\Models;

use App\Enums\LanguageProficiency;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CandidateLanguage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'speaking',
        'writing',
        'listening',
        'understanding',
    ];

    protected function casts(): array
    {
        return [
            'speaking' => LanguageProficiency::class,
            'writing' => LanguageProficiency::class,
            'listening' => LanguageProficiency::class,
            'understanding' => LanguageProficiency::class,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
