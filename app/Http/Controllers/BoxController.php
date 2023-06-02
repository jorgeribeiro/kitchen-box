<?php

namespace App\Http\Controllers;

use App\Actions\StoreBoxAction;
use App\Http\Requests\StoreBoxRequest;
use App\Http\Resources\BoxResource;
use Symfony\Component\HttpFoundation\JsonResponse;

class BoxController extends Controller
{
    /**
     * @param StoreBoxRequest $request
     * @param StoreBoxAction $storeBoxAction
     * @return JsonResponse
     */
    public function store(StoreBoxRequest $request, StoreBoxAction $storeBoxAction): JsonResponse
    {
        $box = $storeBoxAction->handle($request);

        return response()->json(new BoxResource($box));
    }
}
