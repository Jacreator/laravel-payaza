<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::apiResource('whitelist', 'App\Http\Controllers\WhitelistController');
Route::apiResource('keys', 'App\Http\Controllers\UserKeyController');
Route::apiResource('users', 'App\Http\Controllers\UserController');
Route::apiResource('user_identity', 'App\Http\Controllers\UserIDController');

Route::post('transactions/init', [TransactionController::class, 'initTransaction']);
Route::post('transactions/verify', [TransactionController::class, 'verifyTransaction']);