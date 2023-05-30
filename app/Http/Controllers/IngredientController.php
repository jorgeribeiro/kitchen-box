<?php

namespace App\Http\Controllers;

use App\Enums\IngredientMeasures;
use App\Http\Requests\StoreIngredientRequest;
use App\Http\Resources\IngredientCollection;
use App\Models\Ingredient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class IngredientController extends Controller
{

    public function index(): JsonResource
    {
        return new IngredientCollection(Ingredient::paginate());
    }

    /**
     * @param StoreIngredientRequest $request
     * @return JsonResponse
     */
    public function store(StoreIngredientRequest $request): JsonResponse
    {
        Ingredient::create([
            'name' => $request->string('name'),
            'measure' => $request->enum('measure', IngredientMeasures::class),
            'supplier' => $request->string('supplier'),
        ]);

        return response()->json(['message' => 'Ingredient created successfully'], 201);
    }
}
