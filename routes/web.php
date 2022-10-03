<?php

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
Route::view('login', 'auth.login');
Route::view('register', 'auth.register');
Route::post('register', [RegisterController::class, 'store']);
Route::post('login', [LoginController::class, 'store']);
Route::any('personal-account', [PersonalAccountController::class, 'index']);
Route::any('agent-account', [AgentAccountController::class, 'index']);
Route::get('logout', [LoginController::class, 'logout']);


