<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'title'=> fake()->name(),
            'description' => fake()->text(),
            'release_year' => fake()->date(),
            'photo_url' => fake()->image(),
            'background_url' => fake()->image(),
            'trailer_url' => fake()->image()
        ];
    }
}
