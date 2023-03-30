<?php

use App\Http\Controllers\CurrencyPairController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('users/register', [UserController::class, 'register']);
Route::post('users/login', [UserController::class, 'login']);
Route::post('/currency/add', [CurrencyPairController::class, 'addCurrencyPair']);
Route::get('/currency/liste', [CurrencyPairController::class, 'getCurrencyPairs']);
Route::put('/currency/update/{pair}', [CurrencyPairController::class, 'updateCurrencyPairs']);
Route::get('/api-status', function () {
    return response()->json(['status' => 'API fonctionnelle',]);
});
Route::get('currency/show/{id}', [CurrencyPairController::class,'showCurrencyPair']);
Route::get('currency/delete/{id}', [CurrencyPairController::class,'deleteCurrencyPair']);
