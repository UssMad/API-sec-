<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'raw_content_id',
    'blueprint_id',
    'hook',
    'body',
    'status',
])]
class GeneratedPost extends Model
{
    /** @use HasFactory<\Database\Factories\GeneratedPostFactory> */
    use HasFactory;

    public function rawContent(): BelongsTo
    {
        return $this->belongsTo(RawContent::class);
    }

    public function blueprint(): BelongsTo
    {
        return $this->belongsTo(Blueprint::class);
    }
}
