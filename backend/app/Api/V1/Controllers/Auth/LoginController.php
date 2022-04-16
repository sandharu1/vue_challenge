<?php

namespace App\Api\V1\Controllers\Auth;

use App\Api\V1\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function login(LoginRequest $request)
    {
        try {
            if (!Auth::attempt($request->only('email', 'password'))) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Credentials not match'
                ], 401);
            }

            $tokenData = auth()->user()->createToken("API-VC");

            return response()->json([
                'status' => 'success',
                'message' => null,
                'auth_data' => [
                    'access_token' => $tokenData->plainTextToken,
                    'token_type' => 'Bearer'
                ],
                'user_data' => auth()->user(),
            ], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Tokens Revoked'
        ]);
    }
}
