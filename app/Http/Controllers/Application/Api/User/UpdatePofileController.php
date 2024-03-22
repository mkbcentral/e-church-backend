<?php

namespace App\Http\Controllers\Application\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UpdatePofileController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, User $user)
    {
        try {
            $fields = $request->validate([
                'name' => 'required|string',
                'phone' => 'required',
                'email' => 'required|email',
            ]);
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
