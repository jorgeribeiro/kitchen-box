<?php

namespace Tests\Feature;

use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RecipeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_endpoint_returns_list_of_recipes_with_pagination(): void
    {
        Recipe::factory()->count(10)->create();
        $response = $this->getJson('/api/recipes');
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'description',
                    'ingredients',
                ],
            ],
            'links',
            'meta',
        ]);
    }

    public function test_store_endpoint_creates_new_recipe(): void
    {
        // Create the ingredients for the recipe
        $ingredient1 = Ingredient::factory()->create();
        $ingredient2 = Ingredient::factory()->create();

        $payload = [
            'name' => 'Test Recipe',
            'description' => 'This is a test recipe',
            'ingredients' => [
                ['id' => $ingredient1->id, 'amount' => 200],
                ['id' => $ingredient2->id, 'amount' => 300],
            ],
        ];
        $response = $this->postJson('/api/recipes', $payload);
        $response->assertOk();
        $response->assertJson([
            'name' => 'Test Recipe',
            'description' => 'This is a test recipe',
            'ingredients' => [
                [
                    'name' => $ingredient1->name,
                    'amount' => "200 {$ingredient1->measure->value}",
                ],
                [
                    'name' => $ingredient2->name,
                    'amount' => "300 {$ingredient2->measure->value}",
                ],
            ],
        ]);
    }
}
