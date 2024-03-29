<?php

namespace App\Http\Controllers\Application\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class GetuserInforController extends Controller
{
    public function getAuthUser()
    {
        return response()->json([
            'user' =>  new UserResource(Auth::user()),
            'message' => ''
        ]);
    }
}
