<?php

namespace App\Http\Controllers\Application\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AttachRoleToUserController extends Controller
{
    public function __invoke(Request $request, User $user)
    {
        try {
            $user->update([
                'role_id' => $request->role_id
            ]);
            return response()->json([
                'message' => 'Action bien réalisee'
            ], 200);
        } catch (HttpException $ex) {
            return response([
                'error' => $ex->getMessage(),
            ], 500);
        }
    }
}
