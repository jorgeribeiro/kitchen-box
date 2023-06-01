<?php

namespace App\Actions;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GetIngredientsToOrderAction implements ActionInterface
{
    /**
     * @param Request $request
     * @return array
     */
    public function handle(Request $request): array
    {
        $orderDate = $request->query('order_date');
        $startDate = Carbon::parse($orderDate)->startOfDay();
        $endDate = $startDate->copy()->addDays(7)->endOfDay();

        return DB::table('boxes')
            ->join('box_recipe', 'boxes.id', '=', 'box_recipe.box_id')
            ->join('recipes', 'box_recipe.recipe_id', '=', 'recipes.id')
            ->join('ingredient_recipe', 'recipes.id', '=', 'ingredient_recipe.recipe_id')
            ->join('ingredients', 'ingredient_recipe.ingredient_id', '=', 'ingredients.id')
            ->whereBetween('boxes.delivery_date', [$startDate, $endDate])
            ->groupBy('ingredients.id')
            ->selectRaw('ingredients.name, SUM(ingredient_recipe.amount) as total_amount, ingredients.measure')
            ->get()
            ->toArray();
    }
}
