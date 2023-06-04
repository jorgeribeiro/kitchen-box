<?php

namespace Tests\Unit;

use App\Actions\StoreIngredientAction;
use App\Models\Ingredient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class StoreIngredientActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_stores_an_ingredient(): void
    {
        $request = new Request([
            'name' => 'Sugar',
            'measure' => 'g',
            'supplier' => 'ABC Supplier',
        ]);

        $action = new StoreIngredientAction();
        $ingredient = $action->handle($request);
        $this->assertInstanceOf(Ingredient::class, $ingredient);
        $this->assertEquals('Sugar', $ingredient->name);
        $this->assertEquals('g', $ingredient->measure->value);
        $this->assertEquals('ABC Supplier', $ingredient->supplier);
    }
}
