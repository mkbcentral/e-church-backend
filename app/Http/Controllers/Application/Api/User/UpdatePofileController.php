<?php

namespace App\Http\Controllers\Application\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repository\FileRepository;
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
                'avatar' => 'string|nullable',
            ]);
            if ($fields['avatar'] == null) {
                $user->update([
                    'name' => $fields['name'],
                    'phone' => $fields['phone'],
                    'email' => $fields['email'],
                ]);
            } else {
                if ($user->avatar) {
                    // Delete the old avatar from the server
                    FileRepository::deleteFile($user->avatar, 'public');
                }
                $user->update([
                    'name' => $fields['name'],
                    'phone' => $fields['phone'],
                    'email' => $fields['email'],
                    'avatar' => FileRepository::uploadFile($request->avatar, 'public', 'user/avatar/'),
                ]);
            }

            return response([
                'data' => new UserResource($user),
                'token' => $request->bearerToken()
            ], 200);
        } catch (HttpException $ex) {
            return response([
                'error' => $ex->getMessage(),
                'code' => $ex->getStatusCode(),
            ], 500);
        }
    }
}
