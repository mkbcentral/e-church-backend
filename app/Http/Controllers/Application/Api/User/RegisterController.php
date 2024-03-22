<?php

namespace App\Http\Controllers\Application\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\HttpException;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'phone' => 'required|unique:users',
                'password' => 'required',
            ]);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);
            $token = $user->createToken('token')->plainTextToken;
            return response([
                'user' => new UserResource($user),
                'token' => $token,
                'message' => 'Inscription avec succès.',
            ], 201);
        } catch (HttpException $ex) {
            return response([
                'error' => $ex->getMessage(),
                'code' => $ex->getStatusCode(),
            ]);
        }
    }
}
