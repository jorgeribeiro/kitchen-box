<?php

namespace Tests\Feature;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BoxControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_endpoint_creates_new_box()
    {
        // Create a mock user and authenticate them for the test
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create the recipes for the box
        $recipe1 = Recipe::factory()->create();
        $recipe2 = Recipe::factory()->create();

        $deliveryDate = now()->addDays(3)->toDateString();
        $payload = [
            'delivery_date' => $deliveryDate,
            'recipe_ids' => [$recipe1->id, $recipe2->id],
        ];
        $response = $this->postJson('/api/boxes', $payload);
        $response->assertOk();
        $response->assertJson([
            'delivery_date' => $deliveryDate,
             'recipes' => [
                 [
                     'id' => $recipe1->id,
                     'name' => $recipe1->name,
                     'description' => $recipe1->description,
                 ],
                 [
                     'id' => $recipe2->id,
                     'name' => $recipe2->name,
                     'description' => $recipe2->description,
                 ],
             ],
        ]);
    }
}
