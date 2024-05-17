<?php

use App\Http\Controllers\Application\Api\Church\ChangeChurchStatusController;
use App\Http\Controllers\Application\Api\Church\CreateChurchController;
use App\Http\Controllers\Application\Api\Church\GetChurchController;
use App\Http\Controllers\Application\Api\Church\UpdateInfoChurchController;
use App\Http\Controllers\Application\Api\GetListRoleController;
use App\Http\Controllers\Application\Api\Preaching\CreatePreachingController;
use App\Http\Controllers\Application\Api\Preaching\DeletePreachingController;
use App\Http\Controllers\Application\Api\Preaching\MakeOnlinePreachingController;
use App\Http\Controllers\Application\Api\Preaching\UpdatePreachingController;
use App\Http\Controllers\Application\Api\User\AttachRoleToUserController;
use App\Http\Controllers\Application\Api\User\GetuserInforController;
use App\Http\Controllers\Application\Api\User\LoginController;
use App\Http\Controllers\Application\Api\User\LogoutController;
use App\Http\Controllers\Application\Api\User\PasswordResetController;
use App\Http\Controllers\Application\Api\User\RegisterController;
use App\Http\Controllers\Application\Api\User\UpdatePofileController;
use App\Http\Controllers\ListChurchController;
use Illuminate\Support\Facades\Route;
//User routes
Route::prefix('user')->group(function () {
    Route::post('/login', LoginController::class);
    Route::post('/register', RegisterController::class);
    Route::get('/logout', LogoutController::class)->middleware('auth:sanctum');
    Route::put('/update-profile/{user}', UpdatePofileController::class)->middleware('auth:sanctum');
    Route::post('/send-password-reset-token', [PasswordResetController::class, 'sendPasswordResetToken']);
    Route::post('/reset-password', [PasswordResetController::class, 'resetPassword']);
    Route::get('/auth-user', [GetuserInforController::class, 'getAuthUser'])->middleware('auth:sanctum');
    Route::put('attach-role/{user}', AttachRoleToUserController::class)->middleware('auth:sanctum');
});

Route::middleware('auth:sanctum')->group(function () {
    //Church routes
    Route::prefix('church')->group(function () {
        Route::post('/create', CreateChurchController::class);
        Route::put('/update/{church}', UpdateInfoChurchController::class);
        Route::get('/change-status/{church}', [ChangeChurchStatusController::class]);
        Route::get('/list', [ListChurchController::class, 'getListChurches']);
        Route::controller(GetChurchController::class)->group(function () {
            Route::get('church-by-user/{id}', 'getChurchByUserId');
        });
    });
    //Preaching routes
    Route::prefix('preaching')->group(function () {
        Route::post('/create', CreatePreachingController::class);
        Route::put('/update/{preaching}', UpdatePreachingController::class);
        Route::put('/make-online/{preaching}', MakeOnlinePreachingController::class);
        Route::delete('/delete/{preaching}', DeletePreachingController::class);
    });
    //Preaching routes
    Route::prefix('role')->group(function () {
        Route::get('/list', GetListRoleController::class);
    });
});
