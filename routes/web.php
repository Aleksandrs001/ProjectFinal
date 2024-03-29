<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\BalanceTransferController;
use App\Http\Controllers\CreateCurrencyAcc;
use App\Http\Controllers\CryptoBuyController;
use App\Http\Controllers\CryptoCyrrencyController;
use App\Http\Controllers\CryptoSellController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Session;
use App\Http\Controllers\Test;
use App\Http\Controllers\TransactionHistoryController;
use Illuminate\Support\Facades\Route;




Session::initialize();
Route::get('/test', [Test::class, 'run'])->name('test');

Route::get('/', function () {
    return view('welcome');
}
)->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AccountController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/balance-transfer', [BalanceTransferController::class, 'showForm'])->name('balance-transfer');
    Route::get('/transaction-history', [TransactionHistoryController::class, 'showForm'])->name('transaction-history.showForm');

    Route::get('/transaction-history-show-all', [TransactionHistoryController::class, 'showAll'])->name('transaction-history');
    Route::get('/transaction-history-show-', [TransactionHistoryController::class, 'showUserChoice'])->name('transaction-history');
    Route::get('/transaction-history-search-', [TransactionHistoryController::class, 'showSearchByDate'])->name('transaction-history');
    Route::get('/transaction-history-search-date', [TransactionHistoryController::class, 'showSearchByDate'])->name('transaction-history');


//    Route::match(['GET','POST'],'/buyCrypto', 'CryptoCyrrencyController@buyCrypto');


    Route::get('/crypto', [CryptoCyrrencyController::class, 'showForm'])->name('crypto');
    Route::get('/crypto{symbol}', [CryptoCyrrencyController::class, 'userChoice'])->name('crypto');
    Route::post('/cryptoBuy', [CryptoBuyController::class, 'buyCrypto'])->name('crypto');
    Route::post('/cryptoSell', [CryptoSellController::class, 'sellCrypto'])->name('crypto');

    Route::post('/balance-transfer', [BalanceTransferController::class, 'transfer'])->name('balance-transfer');
    Route::post('/createCurrencyAcc', [CreateCurrencyAcc::class, 'createCurrencyAcc'])->name('createCurrencyAcc');
    Route::get('/accounts/{account}/edit', [AccountController::class, 'edit'])->name('accounts.edit');
    Route::post('/accounts/{account}/softDelete', [AccountController::class, 'softDelete'])->name('accounts.softDelete');
    Route::put('/accounts/{account}', [AccountController::class, 'update'])->name('accounts.update');
});

require __DIR__ . '/auth.php';
