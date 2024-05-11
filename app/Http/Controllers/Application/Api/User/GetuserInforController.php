<?php

namespace App\Http\Controllers\Application\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class GetuserInforController extends Controller
{
    public function getAuthUser(Request $request)
    {
        try {
            return response()->json([
                'data' =>  new UserResource(Auth::user()),
                'token' =>  $request->bearerToken()
            ], 200);
        } catch (HttpException $ex) {
            return response([
                'error' => $ex->getMessage(),
            ], 500);
        }
    }
}
