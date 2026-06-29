<?php

namespace Database\Factories;

use App\Models\Blueprint;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Blueprint>
 */
class BlueprintFactory extends Factory
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
            'name' => fake()->sentence(2),
            'tone' => fake()->randomElement([
                'professional',
                'casual',
                'humorous',
                'inspirational',
                'educational',
                'authoritative',
                'playful',
            ]),
            'max_hashtags' => fake()->numberBetween(0, 10),
            'max_characters' => fake()->numberBetween(100, 280),
        ];
    }
}
