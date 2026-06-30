<?php

namespace App\Models;

use Database\Factories\GeneratedPostFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'raw_content_id',
    'blueprint_id',
    'hook_propose',
    'body_points',
    'technical_readability_score',
    'suggested_hashtags',
    'tone_compliance_justification',
    'payload_brut',
])]
class GeneratedPost extends Model
{
    /** @use HasFactory<GeneratedPostFactory> */
    use HasFactory;

    public function rawContent(): BelongsTo
    {
        return $this->belongsTo(RawContent::class);
    }

    public function blueprint(): BelongsTo
    {
        return $this->belongsTo(Blueprint::class);
    }

    protected function casts(): array
    {
        return [
            'body_points' => 'array',
            'suggested_hashtags' => 'array',
            'payload_brut' => 'array',
        ];
    }
}
