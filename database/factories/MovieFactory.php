<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Movie;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->word(),
            'slug' => fake()->word(),
            'synopsis' => fake()->realTextBetween($minNbChars = 160, $maxNbChars = 200, $indexSize = 2),
            'genre' => fake()->word(),
            'director' => fake()->name(),
            'release_date' => fake()->dateTime(),
            'rating' => fake()->numberBetween(1,5),
            'duration_minutes' => fake()->numberBetween(1, 250),
        ];
    }
}
