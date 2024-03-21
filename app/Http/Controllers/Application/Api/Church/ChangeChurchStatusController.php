<?php

namespace App\Http\Controllers\Application\Api\Church;

use App\Enums\ChurchStatus;
use App\Http\Controllers\Controller;
use Exception;

class ChangeChurchStatusController extends Controller
{
    public function makePending()
    {
        try {
            $church = auth()->user()->church->update([
                'status' => ChurchStatus::PENDING,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Statut de l\'église mis à jour avec succès',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => "Quelque chose s'est mal passé, veuillez réessayer plus tard",
            ]);
        }
    }

    public function makeApproved()
    {
        try {
            auth()->user()->church->update([
                'status' => ChurchStatus::APPROVED,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Statut de l\'église mis à jour avec succès',
            ], 200);
        } catch (Exception $th) {
            return response()->json([
                'error' => "Quelque chose s'est mal passé, veuillez réessayer plus tard",
                'problem' => $th->getMessage(),
            ]);
        }
    }

    public function makeRejected()
    {
        try {
            $church = auth()->user()->church->update([
                'status' => ChurchStatus::REJECTED,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Statut de l\'église mis à jour avec succès',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => "Quelque chose s'est mal passé, veuillez réessayer plus tard",
            ]);
        }
    }

    public function makeSuspended()
    {
        try {
            $church = auth()->user()->church->update([
                'status' => ChurchStatus::SUSPENDED,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Statut de l\'église mis à jour avec succès',
            ], 200);
        } catch (Exception $th) {
            return response()->json([
                'error' => "Quelque chose s'est mal passé, veuillez réessayer plus tard",
                'problem' => $th->getMessage(),
            ]);
        }
    }
}
