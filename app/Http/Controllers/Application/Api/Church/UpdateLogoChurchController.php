<?php

namespace App\Http\Controllers\Application\Api\Church;

use App\Http\Controllers\Controller;
use App\Repository\FileRepository;
use Illuminate\Http\Request;

class UpdateLogoChurchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        try {
            /**
             * Validate the request
             */
            $request->validate([
                'logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);
            $church = auth()->user()->church->update([
                'logo' => FileRepository::uploadFile($request->logo, 'public', 'church/logo/'),
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Logo de l\'église mis à jour avec succès',
                'data' => $church,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => "Logo de l'église mis à jour avec succès",
            ]);
        }
    }
}
