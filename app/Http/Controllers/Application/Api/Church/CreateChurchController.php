<?php

namespace App\Http\Controllers\Application\Api\Church;

use App\Http\Controllers\Controller;
use App\Models\Church;
use App\Repository\FileRepository;
use Exception;
use Illuminate\Http\Request;

class CreateChurchController extends Controller
{
    public function __invoke(Request $request)
    {
        try {
            $church = Church::create([
                'name' => $request->name,
                'abbreviation' => $request->abbreviation,
                'logo' => FileRepository::uploadFile($request->logo, 'public', 'church/logo/'),
                'status' => $request->status ?? 'PENDING',
                'user_id' => auth()->id(),
            ]);
            return response()->json([

                'message' => 'Church created successfully',
                'data' => $church,
            ], 200);
        } catch (Exception $ex) {
            return response()->json([
                'error' => $request->logo,
            ]);
        }
    }
}
