<?php

namespace App\Http\Controllers\Application\Api\User;

use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'Déconnexion avec succès.',
        ], 200);
    }
}
