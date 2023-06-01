<?php

namespace App\Http\Controllers;

use App\Actions\StoreRecipeAction;
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
     * @param StoreRecipeAction $storeRecipeAction
     * @return JsonResponse
     */
    public function store(StoreRecipeRequest $request, StoreRecipeAction $storeRecipeAction): JsonResponse
    {
        $storeRecipeAction->handle($request);

        return response()->json(['message' => 'Recipe created successfully'], 201);
    }
}
