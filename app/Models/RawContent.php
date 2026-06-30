<?php

namespace App\Models;

use Database\Factories\RawContentFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'user_id',
    'blueprint_id',
    'title',
    'content',
    'status',
])]
class RawContent extends Model
{
    /** @use HasFactory<RawContentFactory> */
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function blueprint(): BelongsTo
    {
        return $this->belongsTo(Blueprint::class);
    }

    public function generatedPosts(): HasMany
    {
        return $this->hasMany(GeneratedPost::class);
    }
}
