<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecipeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'ingredients' => $this->ingredients->map(function ($ingredient) {
                return [
                    'name' => $ingredient->name,
                    'amount' => "{$ingredient->pivot->amount} {$ingredient->measure->value}",
                ];
            })
        ];
    }
}
