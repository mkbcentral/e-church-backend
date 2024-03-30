<?php

namespace App\Http\Controllers\Application\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\HttpException;

class GetuserInforController extends Controller
{
    public function getAuthUser()
    {
        try {
            return response()->json([
                'user' =>  new UserResource(Auth::user()),
                'message' => ''
            ], 200);
        } catch (HttpException $ex) {
            return response([
                'error' => $ex->getMessage(),
            ]);
        }
    }
}
