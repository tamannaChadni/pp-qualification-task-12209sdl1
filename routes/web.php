<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\TranscationController;
use App\Http\Controllers\User\AgentAccountController;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\PersonalAccountController;
use App\Http\Controllers\User\RegisterController;
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

// Route::get('/', function () {
//     return view('auth.register');
// });
Route::view('login', 'auth.login')->name('login');;
Route::view('/register', 'auth.register');
Route::post('register', [RegisterController::class, 'store']);
Route::post('login', [LoginController::class, 'store']);
// Route::post('login', [LoginController::class, 'store'])->middleware("throttle:login");


Route::middleware(['auth'])->group(function () {
    Route::get('transcation', [TranscationController::class, 'index']);
    Route::post('transcation', [TranscationController::class, 'store']);
    Route::get('account-details', [AccountController::class, 'index']);
    Route::post('account-details', [AccountController::class, 'store']);
    Route::get('logout', [LoginController::class, 'logout']);
});
