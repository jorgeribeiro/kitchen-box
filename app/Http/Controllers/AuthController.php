<?php

namespace App\Http\Controllers;

use App\Actions\AuthenticateUserAction;
use App\Http\Requests\AuthenticateUserRequest;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * @param AuthenticateUserRequest $request
     * @param AuthenticateUserAction $authenticateUserAction
     * @return JsonResponse
     */
    public function login(
        AuthenticateUserRequest $request,
        AuthenticateUserAction $authenticateUserAction
    ): JsonResponse {
        if ($token = $authenticateUserAction->handle($request)) {
            return response()->json(['token' => $token]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }
}
