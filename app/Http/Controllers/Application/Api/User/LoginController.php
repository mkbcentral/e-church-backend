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
                'email' => 'required',
                'password' => 'required',
            ]);
            $user = User::where('email', $request->email)
                ->orWhere('phone', $request->email)
                ->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response([
                    'error' => 'The provided credentials are incorrect.',
                ], 500);
            } else {
                $token = $user->createToken('token')->plainTextToken;
                return response([
                    'data' => new UserResource($user),
                    'token' => $token,
                ], 200);
            }
        } catch (HttpException $ex) {
            return response([
                'error' => $ex->getMessage(),
            ], 500);
        }
    }
}
