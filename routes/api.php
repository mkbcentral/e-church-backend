<?php

use App\Http\Controllers\Application\Api\Church\ChangeChurchStatusController;
use App\Http\Controllers\Application\Api\Church\CreateChurchController;
use App\Http\Controllers\Application\Api\Church\UpdateInfoChurchController;
use App\Http\Controllers\Application\Api\Church\UpdateLogoChurchController;
use App\Http\Controllers\Application\Api\User\GetuserInforController;
use App\Http\Controllers\Application\Api\User\LoginController;
use App\Http\Controllers\Application\Api\User\LogoutController;
use App\Http\Controllers\Application\Api\User\PasswordResetController;
use App\Http\Controllers\Application\Api\User\RegisterController;
use App\Http\Controllers\Application\Api\User\UpdateAvatarController;
use App\Http\Controllers\Application\Api\User\UpdatePofileController;
use App\Http\Controllers\ListChurchController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {
    Route::post('/login', LoginController::class);
    Route::post('/register', RegisterController::class);
    Route::get('/logout', LogoutController::class)->middleware('auth:sanctum');
    Route::put('/update-profile/{user}', UpdatePofileController::class)->middleware('auth:sanctum');
    Route::put('/update-avatar/{user}', UpdateAvatarController::class)->middleware('auth:sanctum');
    Route::post('/send-password-reset-token', [PasswordResetController::class, 'sendPasswordResetToken']);
    Route::post('/reset-password', [PasswordResetController::class, 'resetPassword']);
    Route::get('/auth-user', [GetuserInforController::class, 'getAuthUser'])->middleware('auth:sanctum');
});
Route::prefix('church')->group(function () {
    Route::post('/create', CreateChurchController::class)->middleware('auth:sanctum');
    Route::put('/update-info', UpdateInfoChurchController::class)->middleware('auth:sanctum');
    Route::post('/update-logo', UpdateLogoChurchController::class)->middleware('auth:sanctum');
    Route::get('/make-pending', [ChangeChurchStatusController::class, 'makePending'])->middleware('auth:sanctum');
    Route::get('/make-approved', [ChangeChurchStatusController::class, 'makeApproved'])->middleware('auth:sanctum');
    Route::get('/make-rejected', [ChangeChurchStatusController::class, 'makeRejected'])->middleware('auth:sanctum');
    Route::get('/make-suspended', [ChangeChurchStatusController::class, 'makeSuspended'])->middleware('auth:sanctum');
    Route::get('/list', [ListChurchController::class, 'getListChurches'])->middleware('auth:sanctum');
});
