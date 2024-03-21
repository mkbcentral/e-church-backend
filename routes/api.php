<?php

use App\Http\Controllers\Application\Api\User\LoginController;
use App\Http\Controllers\Application\Api\User\LogoutController;
use App\Http\Controllers\Application\Api\User\PasswordResetController;
use App\Http\Controllers\Application\Api\User\RegisterController;
use App\Http\Controllers\Application\Api\User\UpdateAvatarController;
use App\Http\Controllers\Application\Api\User\UpdatePofileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('user')->group(function () {
    Route::post('/login', LoginController::class);
    Route::post('/register', RegisterController::class);
    Route::get('/logout', LogoutController::class)->middleware('auth:sanctum');
    Route::put('/update-profile', UpdatePofileController::class)->middleware('auth:sanctum');
    Route::post('/update-avatar', UpdateAvatarController::class)->middleware('auth:sanctum');
    Route::post('/send-password-reset-token', [PasswordResetController::class, 'sendPasswordResetToken']);
    Route::post('/reset-password', [PasswordResetController::class, 'resetPassword']);
});
