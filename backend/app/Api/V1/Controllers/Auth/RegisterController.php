<?php

namespace App\Api\V1\Controllers\Auth;

use App\Api\V1\Requests\RegisterRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        try {

            $user = User::create([
                'name' => $request->name,
                'password' => bcrypt($request->password),
                'email' => $request->email
            ]);

            $tokenData = $user->createToken("API-VC");

            return response()->json([
                'status' => 'success',
                'auth_data' => [
                    'access_token' => $tokenData->plainTextToken,
                    'token_type' => 'Bearer'
                ],
                'user_data' => $user,
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
