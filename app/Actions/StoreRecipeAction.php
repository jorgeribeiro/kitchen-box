<?php

namespace App\Actions;

use App\Models\Recipe;
use Illuminate\Http\Request;

class StoreRecipeAction implements ActionInterface
{
    /**
     * @param Request $request
     * @return Recipe
     */
    public function handle(Request $request): Recipe
    {
        // Create the recipe
        $recipe = Recipe::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        // Attach ingredients with amounts to the recipe
        $ingredients = $request->input('ingredients');
        foreach ($ingredients as $ingredient) {
            $recipe->ingredients()->attach($ingredient['id'], ['amount' => $ingredient['amount']]);
        }

        return $recipe;
    }
}
