<?php

namespace Tests\Unit;

use App\Actions\StoreBoxAction;
use App\Models\Box;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class StoreBoxActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_box_with_attached_recipes_and_authenticated_user(): void
    {
        // Create a mock user and authenticate them for the test
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create the recipes for the box
        $recipe1 = Recipe::factory()->create();
        $recipe2 = Recipe::factory()->create();

        $deliveryDate = now();
        $request = new Request([
            'delivery_date' => $deliveryDate,
            'recipe_ids' => [$recipe1->id, $recipe2->id],
        ]);

        $action = new StoreBoxAction();
        $box = $action->handle($request);

        $this->assertInstanceOf(Box::class, $box);
        $this->assertEquals($deliveryDate, $box->delivery_date);
        $this->assertEquals($user->id, $box->user_id);
        $this->assertCount(2, $box->recipes);

        // Assert attached recipes
        $attachedRecipes = $box->recipes->pluck('id')->toArray();
        $this->assertContains($recipe1->id, $attachedRecipes);
        $this->assertContains($recipe2->id, $attachedRecipes);
    }
}
