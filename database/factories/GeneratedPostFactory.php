<?php

namespace Database\Factories;

use App\Models\Blueprint;
use App\Models\GeneratedPost;
use App\Models\RawContent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<GeneratedPost>
 */
class GeneratedPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'raw_content_id' => RawContent::factory(),
            'blueprint_id' => Blueprint::factory(),
            'hook' => fake()->sentence(6),
            'body' => fake()->paragraphs(5, true),
            'status' => fake()->randomElement(['draft', 'posted', 'archived']),
        ];
    }
}
