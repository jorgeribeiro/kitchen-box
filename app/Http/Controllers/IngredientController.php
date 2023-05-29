<?php

namespace App\Http\Controllers;

use App\Enums\IngredientMeasures;
use App\Http\Requests\StoreIngredientRequest;
use App\Models\Ingredient;
use Illuminate\Http\JsonResponse;

class IngredientController extends Controller
{
    /**
     * @param StoreIngredientRequest $request
     * @return JsonResponse
     */
    public function store(StoreIngredientRequest $request): JsonResponse
    {
        $ingredient = Ingredient::create([
            'name' => $request->string('name'),
            'measure' => $request->enum('measure', IngredientMeasures::class),
            'supplier' => $request->string('supplier'),
        ]);

        return response()->json($ingredient);
    }
}
