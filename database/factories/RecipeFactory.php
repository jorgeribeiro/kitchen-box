<?php

namespace Database\Factories;

use App\Enums\IngredientMeasures;
use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
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
            'description' => fake()->text(),
        ];
    }

    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterCreating(function (Recipe $recipe) {
            $ingredients = Ingredient::factory()->count(3)->create();

            foreach ($ingredients as $ingredient) {
                if ($ingredient->measure === IngredientMeasures::PIECES) {
                    $amount = $this->faker->numberBetween(1, 10);
                } else {
                    $amount = $this->faker->randomFloat(2, 100, 1000);
                }
                $recipe->ingredients()->attach($ingredient, ['amount' => $amount]);
            }
        });
    }
}
