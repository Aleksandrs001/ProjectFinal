<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\BalanceTransferController;
use App\Http\Controllers\CreateCurrencyAcc;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Session;
use Illuminate\Support\Facades\Route;


Session::initialize();
Route::get('/', function () {
    return view('welcome');
}
)->name('dashboard');

Route::middleware('auth')->group(function () {
Route::get('/dashboard', [AccountController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/balance-transfer', [BalanceTransferController::class, 'showForm'])->name('balance-transfer.showForm');
    Route::post('/balance-transfer', [BalanceTransferController::class, 'transfer'])->name('balance-transfer');
    Route::post('/createCurrencyAcc', [CreateCurrencyAcc::class, 'createCurrencyAcc'])->name('createCurrencyAcc');
    Route::get('/accounts/{account}/edit', [AccountController::class, 'edit'])->name('accounts.edit');
    Route::put('/accounts/{account}', [AccountController::class, 'update'])->name('accounts.update');
});

require __DIR__ . '/auth.php';
