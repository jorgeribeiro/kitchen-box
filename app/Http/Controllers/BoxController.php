<?php

namespace App\Http\Controllers;

use App\Actions\StoreBoxAction;
use App\Http\Requests\StoreBoxRequest;
use App\Http\Resources\BoxResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BoxController extends Controller
{
    /**
     * @param StoreBoxRequest $request
     * @param StoreBoxAction $storeBoxAction
     * @return JsonResource
     */
    public function store(StoreBoxRequest $request, StoreBoxAction $storeBoxAction): JsonResource
    {
        $box = $storeBoxAction->handle($request);

        return new BoxResource($box);
    }
}
