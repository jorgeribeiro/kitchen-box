<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecipeRequest;
use App\Models\Recipe;
use Illuminate\Http\JsonResponse;

class RecipeController extends Controller
{
    /**
     * @param StoreRecipeRequest $request
     * @return JsonResponse
     */
    public function store(StoreRecipeRequest $request): JsonResponse
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

        return response()->json(['message' => 'Recipe created successfully'], 201);
    }
}
