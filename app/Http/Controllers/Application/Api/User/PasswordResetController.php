<?php

namespace App\Http\Controllers\Application\Api\User;

use App\Http\Controllers\Controller;
use App\Mail\ApiResetPasswordMail;
use App\Models\ApiPasswordResetToken;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class PasswordResetController extends Controller
{
    /**
     * Send password reset token to user email
     */
    public function sendPasswordResetToken(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email'
            ]);
            $user = User::where('email', $request->email)->first();

            # code...
            if ($user->apiPasswordResetToken) {
                $user->apiPasswordResetToken->delete();
            }
            $code = rand(100000, 999999);
            $token = ApiPasswordResetToken::create([
                'user_id' => $user->id,
                'code' => $code,
            ]);
            Mail::send(new ApiResetPasswordMail($token));
            return response()->json([
                'message' => 'Code de validation bien envoyé.'
            ], 200);
        } catch (Exception $ex) {
            return response([
                'error' => $ex->getMessage(),
            ]);
        }
    }
    /**
     * Check if the code is correct
     */
    public function checkCode($email, $code): bool
    {
        $user = User::where('email', $email)->first();
        if ($user->apiPasswordResetToken->code === $code) {
            return true;
        }
        return false;
    }
    /**
     * Reset password
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'code' => 'required|numeric',
            'password' => 'required'
        ]);
        $user = User::where('email', $request->email)->first();
        if ($this->checkCode($user->email, $request->code) == true) {
            $user->update([
                'password' => bcrypt($request->password)
            ]);
            $user->apiPasswordResetToken->delete();
            return response()->json([
                'message' => 'Mot de passe bien réinitialisé.'
            ], 200);
        } else {
            return response()->json([
                'error' => 'Code de validation incorrect.'
            ]);
        }
    }
}
