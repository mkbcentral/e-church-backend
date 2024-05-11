<?php

namespace App\Http\Controllers\Application\Api\Church;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChurchResource;
use App\Models\Church;
use App\Repository\FileRepository;
use Exception;
use Illuminate\Http\Request;

class UpdateInfoChurchController extends Controller
{
    public function __invoke(Request $request, Church $church)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'abbreviation' => 'nullable|string',
                'logo' => 'nullable|string',
            ]);
            if ($request->logo == null) {
                $church->update([
                    'name' => $request->name,
                    'abbreviation' => $request->abbreviation,
                ]);
            } else {
                // Check if the user already has an avatar
                if ($church->logo) {
                    // Delete the old avatar from the server
                    FileRepository::deleteFile($church->logo, 'public');
                }
                $church->update([
                    'name' => $request->name,
                    'abbreviation' => $request->abbreviation,
                    'logo' =>  FileRepository::uploadFile($request->logo, 'public', 'church/logo/'),
                ]);
            }

            return response()->json([
                'message' => "Info de l'église mise à jour avec succès",
                'church' => new ChurchResource($church),
            ], 200);
        } catch (Exception $ex) {
            return response()->json([
                'error' => $ex->getMessage(),
            ]);
        }
    }
}
