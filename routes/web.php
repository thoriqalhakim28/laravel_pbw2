<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DetailTransactionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function() {
    Route::prefix('dashboard')->group(function() {
        Route::get('user', [UserController::class, 'index'])->name('user');
        Route::get('userRegistration', [UserController::class, 'create'])->name('userRegistration');
        Route::post('userStore', [UserController::class, 'store'])->name('userStore');
        Route::get('userView/{user}', [UserController::class, 'show'])->name('userView');
        Route::put('userUpdate/{user}', [UserController::class, 'update'])->name('userUpdate');
        Route::get('getAllUser', [UserController::class, 'getAllUser'])->name('userGetAllPengguna');
    });
    Route::prefix('dashboard')->group(function() {
        Route::get('koleksi', [CollectionController::class, 'index'])->name('koleksi');
        Route::get('koleksiRegistration', [CollectionController::class, 'create'])->name('koleksiRegistration');
        Route::post('koleksiStore', [CollectionController::class, 'store'])->name('koleksiStore');
        Route::get('koleksiView/{collection}', [CollectionController::class, 'show'])->name('koleksiView');
        Route::put('koleksiUpdate/{collection}', [CollectionController::class, 'update'])->name('koleksiUpdate');
        Route::get('getAllCollection', [CollectionController::class, 'getAllCollection'])->name('koleksiGetAllCollection');
    });
    Route::prefix('dashboard')->group(function() {
        Route::get('transaksi', [TransactionController::class, 'index'])->name('transaksi');
        Route::get('transaksiTambah', [TransactionController::class, 'create'])->name('transaksiTambah');
        Route::post('transaksiStore', [TransactionController::class, 'store'])->name('transaksiStore');
        Route::get('transaksiView/{transaction}', [TransactionController::class, 'show'])->name('transaksiView');
        Route::get('getAllTransaction', [TransactionController::class, 'getAllTransaction'])->name('getAllTransaction');
    });
    Route::prefix('dashboard')->group(function() {
        Route::get('detailTransactionKembalikan/{detailTransactionId}', [DetailTransactionController::class, 'detailTransactionKembalikan'])->name('detailTransactionKembalikan');
        Route::put('detailTransactionUpdate', [DetailTransactionController::class, 'update'])->name('detailTransactionUpdate');
        Route::get('getAllDetailTransactions/{transactionId}', [DetailTransactionController::class, 'getAllDetailTransactions'])->name('getAllDetailTransactions');
    });

});

require __DIR__.'/auth.php';
