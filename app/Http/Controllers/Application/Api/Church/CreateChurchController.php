<?php

namespace App\Http\Controllers\Application\Api\Church;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChurchResource;
use App\Models\Church;
use App\Repository\FileRepository;
use Exception;
use Illuminate\Http\Request;

class CreateChurchController extends Controller
{
    public function __invoke(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'abbreviation' => 'nullable|string',
                'logo' => 'nullable|string',
            ]);
            $logoUrl = null;
            if ($request->logo != null) {
                $logoUrl = FileRepository::uploadFile($request->logo, 'public', 'church/logo/');
            }
            $church = Church::create([
                'name' => $request->name,
                'abbreviation' => $request->abbreviation,
                'logo' => $logoUrl,
                'status' => $request->status ?? 'PENDING',
                'user_id' => auth()->id(),
            ]);
            return response()->json([
                'data' => new ChurchResource($church),
            ], 200);
        } catch (Exception $ex) {
            return response()->json([
                'error' => $ex->getMessage(),
            ], 500);
        }
    }
}
