<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Ingredient;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IngredientControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_endpoint_returns_list_of_ingredients_with_pagination(): void
    {
        Ingredient::factory()->count(10)->create();
        $response = $this->getJson('/api/ingredients');
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'measure',
                    'supplier',
                ],
            ],
            'links',
            'meta',
        ]);
    }

    public function test_store_endpoint_creates_new_ingredient(): void
    {
        $payload = [
            'name' => 'Sugar',
            'measure' => 'g',
            'supplier' => 'ABC Supplier',
        ];
        $response = $this->postJson('/api/ingredients', $payload);
        $response->assertOk();
        $response->assertJson([
            'name' => 'Sugar',
            'measure' => 'g',
            'supplier' => 'ABC Supplier',
        ]);
    }
}
