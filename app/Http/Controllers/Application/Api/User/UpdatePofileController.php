<?php

namespace App\Http\Controllers\Application\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UpdatePofileController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        try {
            $fields = $request->validate([
                'name' => 'required|string',
                'phone' => 'required',
                'email' => 'required|email',
            ]);
            $user = auth()->user();
            $user->update($fields);
            return response([
                'user' => new UserResource($user),
                'message' => 'Modification avec succès.',
            ], 201);
        } catch (HttpException $ex) {
            return response([
                'error' => $ex->getMessage(),
                'code' => $ex->getStatusCode(),
            ]);
        }
    }
}
