<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('members', 'pages.members')->name('members');
    Route::view('deposit', 'pages.deposit')->name('deposit');
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('profile', 'profile')->name('profile');
});
require __DIR__ . '/auth.php';
