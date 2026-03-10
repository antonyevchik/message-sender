<?php

use App\Http\Controllers\MessagesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::inertia('/', 'Welcome', [
    'canRegister' => Features::enabled(Features::registration()),
])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
    Route::resource('users', UsersController::class)
        ->only(['index']);
    Route::resource('users.messages', MessagesController::class)
        ->only(['index', 'store']);
});

require __DIR__ . '/settings.php';
