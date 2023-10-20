<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function __invoke(LoginRequest $request): JsonResponse
    {
        $request->authenticate();
        $user = User::where('email', $request->email)->first();

        return response()->json([
            'token' => $user->createToken($request->email)->plainTextToken
        ]);
    }
}
