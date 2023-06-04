<?php

namespace Tests\Unit;

use App\Actions\StoreRecipeAction;
use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class StoreRecipeActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_recipe_with_attached_ingredients(): void
    {
        // Create the ingredients for the recipe
        $ingredient1 = Ingredient::factory()->create();
        $ingredient2 = Ingredient::factory()->create();

        $request = new Request([
            'name' => 'Test Recipe',
            'description' => 'This is a test recipe',
            'ingredients' => [
                ['id' => $ingredient1->id, 'amount' => 200],
                ['id' => $ingredient2->id, 'amount' => 300],
            ],
        ]);

        $action = new StoreRecipeAction();
        $recipe = $action->handle($request);

        $this->assertInstanceOf(Recipe::class, $recipe);
        $this->assertEquals('Test Recipe', $recipe->name);
        $this->assertEquals('This is a test recipe', $recipe->description);
        $this->assertCount(2, $recipe->ingredients);

        // Assert attached ingredients and their amounts
        $attachedIngredients = $recipe->ingredients->pluck('id')->toArray();
        $this->assertContains($ingredient1->id, $attachedIngredients);
        $this->assertContains($ingredient2->id, $attachedIngredients);
        $this->assertEquals(200, $recipe->ingredients->find($ingredient1->id)->pivot->amount);
        $this->assertEquals(300, $recipe->ingredients->find($ingredient2->id)->pivot->amount);
    }
}
