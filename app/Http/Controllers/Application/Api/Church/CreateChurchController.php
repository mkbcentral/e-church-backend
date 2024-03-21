<?php

namespace App\Http\Controllers\Application\Api\Church;

use App\Http\Controllers\Controller;
use App\Models\Church;
use Exception;
use Illuminate\Http\Request;

class CreateChurchController extends Controller
{
    public function __invoke(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'abbreviation' => 'required|string',
            ]);
            $church = Church::create([
                'name' => $request->name,
                'abbreviation' => $request->abbreviation,
                'user_id' => auth()->id(),
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Church created successfully',
                'data' => $church,
            ], 201);
        } catch (Exception $ex) {
            return response()->json([
                'error' => "Quelque chose s'est mal passé, veuillez réessayer plus tard",
            ]);
        }
    }
}
