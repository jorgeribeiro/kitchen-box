<?php

namespace App\Actions;

use App\Enums\IngredientMeasures;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class StoreIngredientAction implements ActionInterface
{
    /**
     * @param Request $request
     * @return Ingredient
     */
    public function handle(Request $request): Ingredient
    {
        return Ingredient::create([
            'name' => $request->input('name'),
            'measure' => $request->enum('measure', IngredientMeasures::class),
            'supplier' => $request->input('supplier'),
        ]);
    }
}
