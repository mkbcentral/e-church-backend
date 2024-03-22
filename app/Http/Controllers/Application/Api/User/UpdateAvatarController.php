<?php

namespace App\Http\Controllers\Application\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Repository\FileRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UpdateAvatarController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        try {
            $request->validate([
                'avatar' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            ]);
            $user = auth()->user();
            $user->update([
                'avatar' => FileRepository::uploadFile($request->avatar, 'public', 'user/avatar')
            ]);
            return response([
                'user' => new UserResource($user),,
                'message' => 'Modification avec succès.',
            ], 201);
            //code...
        } catch (HttpException $ex) {
            return response([
                'error' => $ex->getMessage(),
                'code' => $ex->getStatusCode(),
            ]);
        }
    }
}
