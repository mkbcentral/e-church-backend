<?php

namespace App\Http\Controllers\Application\Api\Preaching;

use App\Http\Controllers\Controller;
use App\Models\Preaching;
use App\Repository\FileRepository;
use Exception;
use Illuminate\Http\JsonResponse;

class DeletePreachingController extends Controller
{
    /**
     *
     * @param Preaching $preaching
     * @return JsonResponse
     */
    public function __invoke(Preaching $preaching)
    {
        try {
            FileRepository::deleteFile($preaching->audio_url, 'public');
            $preaching->delete();
            return response()->json([
                'message' => 'Votre publication est rétirée',
            ], 200);
        } catch (Exception $ex) {
            return response()->json([
                'error' => $ex->getMessage(),
            ], 500);
        }
    }
}
