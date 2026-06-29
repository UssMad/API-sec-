<?php

namespace Database\Factories;

use App\Models\Blueprint;
use App\Models\RawContent;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<RawContent>
 */
class RawContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'blueprint_id' => Blueprint::factory(),
            'title' => fake()->sentence(3),
            'content' => fake()->paragraphs(3, true),
        ];
    }
}
