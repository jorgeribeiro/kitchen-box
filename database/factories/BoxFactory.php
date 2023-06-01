<?php

namespace Database\Factories;

use App\Models\Box;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Box>
 */
class BoxFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'delivery_date' => fake()->date,
            'user_id' => User::factory(),
        ];
    }

    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterCreating(function (Box $box) {
            $recipes = Recipe::factory()->count(3)->create();

            foreach ($recipes as $recipe) {
                $box->recipes()->attach($recipe);
            }
        });
    }
}
