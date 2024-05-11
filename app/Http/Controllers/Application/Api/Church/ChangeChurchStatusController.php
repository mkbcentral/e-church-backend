<?php

namespace App\Http\Controllers\Application\Api\Church;

use App\Http\Controllers\Controller;
use App\Models\Church;
use Exception;
use Illuminate\Http\Request;

class ChangeChurchStatusController extends Controller
{
    public function __invoke(Request $request, Church $church)
    {
        try {
            $church->update([
                'status' => $request,
            ]);
            return response()->json([
                'message' => 'Statut de l\'église mis à jour avec succès',
            ], 200);
        } catch (Exception $th) {
            return response()->json([
                'error' => "Quelque chose s'est mal passé, veuillez réessayer plus tard",
            ]);
        }
    }
}
