<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecipeRequest;
use App\Http\Resources\RecipeCollection;
use App\Models\Recipe;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class RecipeController extends Controller
{
    /**
     * @return JsonResource
     */
    public function index(): JsonResource
    {
        return new RecipeCollection(Recipe::paginate());
    }

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
