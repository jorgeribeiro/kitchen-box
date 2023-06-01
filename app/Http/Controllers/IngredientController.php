<?php

namespace App\Http\Controllers;

use App\Actions\StoreIngredientAction;
use App\Http\Requests\StoreIngredientRequest;
use App\Http\Resources\IngredientCollection;
use App\Models\Ingredient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class IngredientController extends Controller
{
    /**
     * @return JsonResource
     */
    public function index(): JsonResource
    {
        return new IngredientCollection(Ingredient::paginate());
    }

    /**
     * @param StoreIngredientRequest $request
     * @param StoreIngredientAction $storeIngredientAction
     * @return JsonResponse
     */
    public function store(StoreIngredientRequest $request, StoreIngredientAction $storeIngredientAction): JsonResponse
    {
        $storeIngredientAction->handle($request);

        return response()->json(['message' => 'Ingredient created successfully'], 201);
    }
}
