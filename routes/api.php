<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource("/cash", 'api\CashController');
Route::resource("/status", 'api\StatusController');
Route::resource("/tongtin", 'api\TongtinController');
Route::get("/tongtinall", 'api\TongtinController@TongtinAll');

Route::resource("/tongtin_pay", 'api\TongtinPayController');
Route::resource("/loan", 'api\LoanController');

