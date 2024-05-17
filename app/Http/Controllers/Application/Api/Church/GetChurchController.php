<?php

namespace App\Http\Controllers\Application\Api\Church;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChurchResource;
use App\Models\Church;
use Symfony\Component\HttpKernel\Exception\HttpException;

class GetChurchController extends Controller
{
    public function getChurchByUserId(string $id)
    {
        try {
            $church = Church::where('user_id', $id)->first();
            return response()->json([
                'data' =>  new ChurchResource($church),
            ], 200);
        } catch (HttpException $ex) {
            return response([
                'error' => $ex->getMessage(),
            ], 500);
        }
    }
}
