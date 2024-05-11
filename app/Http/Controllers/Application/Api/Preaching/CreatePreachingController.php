<?php

namespace App\Http\Controllers\Application\Api\Preaching;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChurchResource;
use App\Http\Resources\PreachingResource;
use App\Models\Preaching;
use App\Repository\FileRepository;
use Exception;
use Illuminate\Http\Request;

class CreatePreachingController extends Controller
{
    public function __invoke(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string',
                'audio_url' => 'required|nullable',
                'preacher_name' => 'required|string'
            ]);

            $preaching = Preaching::create([
                'title' => $request->title,
                'audio_url' => FileRepository::uploadFile($request->audio_url, 'public', 'church/preachings/', 'audio'),
                'preacher_name' => $request->preacher_name,
                'church_id' => auth()->user()->church->id
            ]);
            return response()->json([
                'data' => new PreachingResource($preaching),
            ], 200);
        } catch (Exception $ex) {
            return response()->json([
                'error' => $ex->getMessage(),
            ], 500);
        }
    }
}
