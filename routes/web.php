<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [AccountController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::get('/accounts/{account}/edit', [AccountController::class, 'edit'])->middleware(['auth'])->name('accounts.edit');
Route::put('/accounts/{account}', [AccountController::class, 'update'])->middleware(['auth'])->name('accounts.update');
Route::get('/', function () {

    return view('welcome', [
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__ . '/auth.php';
