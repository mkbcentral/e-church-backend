<?php

namespace App\Http\Controllers\Application\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\HttpException;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        try {
            $request->validate([
                'login' => 'required',
                'password' => 'required',
            ]);
            $user = User::where('email', $request->login)
                ->orWhere('phone', $request->login)
                ->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response([
                    'message' => 'The provided credentials are incorrect.',
                ], 401);
            } else {
                $token = $user->createToken('token')->plainTextToken;
                return response([
                    'user' => new UserResource($user),
                    'token' => $token,
                    'message' => 'Connexion avec succès.',
                ], 200);
            }
        } catch (HttpException $ex) {
            return response([
                'error' => $ex->getMessage(),
                'code' => $ex->getStatusCode(),
            ]);
        }
    }
}
