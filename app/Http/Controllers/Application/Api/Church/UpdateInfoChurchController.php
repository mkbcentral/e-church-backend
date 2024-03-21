<?php

namespace App\Http\Controllers\Application\Api\Church;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateInfoChurchController extends Controller
{
    public function __invoke(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'abbreviation' => 'required|string',
            ]);
            $church = auth()->user()->church->update([
                'name' => $request->name,
                'abbreviation' => $request->abbreviation,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => "Info de l'église mise à jour avec succès",
                'data' => Auth::user()->church,
            ], 200);
        } catch (Exception $ex) {
            return response()->json([
                'error' => "Quelque chose s'est mal passé, veuillez réessayer plus tard"
            ]);
        }
    }
}
