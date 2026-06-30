<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContentRequest;
use App\Http\Resources\GeneratedPostResource;
use App\Models\Blueprint;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Ai\Enums\Lab;

use function Laravel\Ai\agent;

class ContentController extends Controller
{
    public function repurpose(StoreContentRequest $request)
    {
        $rawContent = auth()->user()->rawContents()->create([
            'blueprint_id' => $request->blueprint_id,
            'title' => mb_substr($request->contenu_brut, 0, 100),
            'content' => $request->contenu_brut,
            'status' => 'processing',
        ]);

        $blueprint = Blueprint::findOrFail($request->blueprint_id);

        try {
            $response = agent(
                instructions: 'You are a social media expert that rewrites technical content into engaging X/Twitter posts. Always respond in JSON with the exact schema requested.',
                schema: fn (JsonSchema $schema) => [
                    'hook_propose' => $schema->string()->required(),
                    'body_points' => $schema->array()->items($schema->string())->required(),
                    'technical_readability_score' => $schema->integer()->min(1)->max(100)->required(),
                    'suggested_hashtags' => $schema->array()->items($schema->string())->required(),
                    'tone_compliance_justification' => $schema->string()->required(),
                ],
            )->prompt(
                sprintf(
                    "Rewrite the following content into an X/Twitter post.\n\nRaw Content:\nTitle: %s\nContent: %s\n\nBlueprint Constraints:\nTone: %s\nMax hashtags: %d\nMax characters: %d\n\nEnsure the tone matches the blueprint, use at most %d hashtags, and keep the total post under %d characters.",
                    $rawContent->title,
                    $rawContent->content,
                    $blueprint->tone,
                    $blueprint->max_hashtags,
                    $blueprint->max_characters,
                    $blueprint->max_hashtags,
                    $blueprint->max_characters,
                ),
                provider: Lab::Groq,
            );

            $generatedPost = $rawContent->generatedPosts()->create([
                'blueprint_id' => $blueprint->id,
                'hook_propose' => $response['hook_propose'],
                'body_points' => $response['body_points'],
                'technical_readability_score' => $response['technical_readability_score'],
                'suggested_hashtags' => $response['suggested_hashtags'],
                'tone_compliance_justification' => $response['tone_compliance_justification'],
                'payload_brut' => [
                    'hook_propose' => $response['hook_propose'],
                    'body_points' => $response['body_points'],
                    'technical_readability_score' => $response['technical_readability_score'],
                    'suggested_hashtags' => $response['suggested_hashtags'],
                    'tone_compliance_justification' => $response['tone_compliance_justification'],
                ],
            ]);

            $rawContent->update(['status' => 'completed']);

            return (new GeneratedPostResource($generatedPost))->response()->setStatusCode(201);
        } catch (\Exception $e) {
            $rawContent->update(['status' => 'failed']);

            return response()->json(['message' => 'Generation failed.'], 500);
        }
    }
}
