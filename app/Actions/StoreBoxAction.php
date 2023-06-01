<?php

namespace App\Actions;

use App\Models\Box;
use Illuminate\Http\Request;

class StoreBoxAction implements ActionInterface
{
    /**
     * @param Request $request
     * @return Box
     */
    public function handle(Request $request): Box
    {
        // Create the box
        $box = Box::create([
            'delivery_date' => $request->input('delivery_date'),
            'user_id' => auth()->user()->id,
        ]);

        // Attach the recipes to the box
        $box->recipes()->attach($request->input('recipe_ids'));

        return $box;
    }
}
