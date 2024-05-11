<?php

namespace App\Http\Controllers\Application\Api\Preaching;

use App\Http\Controllers\Controller;
use App\Models\Preaching;
use Exception;

class MakeOnlinePreachingController extends Controller
{
    public function __invoke(Preaching $preaching)
    {
        try {
            $preaching->update(['is_online' => !($preaching->is_online == true)]);
            return response()->json([
                'message' => $preaching->is_online
                            ?'Votre publication est en ligne'
                            :"Votre publication n'est pas en ligne",
            ], 200);
        } catch (Exception $ex) {
            return response()->json([
                'error' => $ex->getMessage(),
            ], 500);
        }
    }
}
