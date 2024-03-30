<?php

namespace App\Http\Controllers\Application\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repository\FileRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UpdateAvatarController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, User $user)
    {
        try {

            $request->validate([
                'avatar' => 'required',
            ]);
            // Check if the user already has an avatar
            if ($user->avatar) {
                // Delete the old avatar from the server
                FileRepository::deleteFile($user->avatar, 'public');
            }
            // Upload the new avatar
            $user->update([
                'avatar' => FileRepository::uploadFile($request->avatar, 'public', 'user/avatar/')
            ]);
            return response([
                'user' => new UserResource($user),
                'message' => 'Modification avec succès.',
            ], 200);
            //code...
        } catch (HttpException $ex) {
            return response([
                'error' => $ex->getMessage(),
                'code' => $ex->getStatusCode(),
            ]);
        }
    }
}
