<?php

namespace App\Http\Controllers\Application\Api\Preaching;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChurchResource;
use App\Models\Preaching;
use App\Repository\FileRepository;
use Exception;
use Illuminate\Http\Request;

class UpdatePreachingController extends Controller
{
    public function __invoke(Request $request, Preaching $preaching)
    {
        try {
            $request->validate([
                'title' => 'required|string',
                'audio_url' => 'nullable|string',
                'preacher_name' => 'required|string'
            ]);
            if ($request->audio_url != null) {
                $audio = FileRepository::uploadFile($request->audio_url, 'public', 'church/preachings/', 'audio');
                // Check if the user already has an avatar
                if ($preaching->audio_url) {
                    // Delete the old avatar from the server
                    FileRepository::deleteFile($preaching->audio_url, 'public');
                }
                $preaching->update([
                    'title' => $request->title,
                    'audio_url' => $audio,
                    'preacher_name' => $request->preacher_name,
                ]);
            } else {
                $preaching->update([
                    'title' => $request->title,
                    'preacher_name' => $request->preacher_name,
                ]);
            }
            return response()->json([
                'data' => new PReach($preaching),
            ], 200);
        } catch (Exception $ex) {
            return response()->json([
                'error' => $ex->getMessage(),
            ], 500);
        }
    }
}
