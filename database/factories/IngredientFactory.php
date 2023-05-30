<?php

namespace Database\Factories;

use App\Enums\IngredientMeasures;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingredient>
 */
class IngredientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'measure' => fake()->randomElement(IngredientMeasures::class),
            'supplier' => fake()->company(),
        ];
    }
}
