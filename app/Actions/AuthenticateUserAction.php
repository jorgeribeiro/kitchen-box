<?php

namespace App\Actions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateUserAction implements ActionInterface
{
    /**
     * @param Request $request
     * @return string|null
     */
    public function handle(Request $request): ?string
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            return $user->createToken('API Token')->plainTextToken;
        }

        return null;
    }
}
