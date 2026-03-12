<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Theme>
 */
class ThemeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'campania_id' => $this->faker->numberBetween(1, 100),
            'data' => [
                'primary_color' => $this->faker->hexColor(),
                'secondary_color' => $this->faker->hexColor(),
                'success_color' => $this->faker->hexColor(),
                'warning_color' => $this->faker->hexColor(),
                'danger_color' => $this->faker->hexColor(),
                'info_color' => $this->faker->hexColor(),
                'background_color' => $this->faker->hexColor(),
                'text_color' => $this->faker->hexColor(),
            ],
        ];
    }
}
