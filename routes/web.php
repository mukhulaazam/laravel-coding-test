<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{TransactionController,HomeController};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/deposit', [TransactionController::class, 'index'])->name('deposit_list');
Route::post('/deposit', [TransactionController::class, 'store'])->name('deposit_add');

Route::get('/withdrawal', [TransactionController::class, 'withdrawal'])->name('withdrawal_list');
Route::post('/withdrawal', [TransactionController::class, 'withdrawalStore'])->name('withdrawal_add');