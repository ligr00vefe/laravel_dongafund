<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiTokenController;
use App\Http\Controllers\ApiContractController;

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

Route::post("/token", [ ApiTokenController::class, "get" ]); // 토큰 발급
Route::post("/token/extend", [ ApiTokenController::class, "extend" ]); // 토큰 시간 연장

Route::post("/contract/incomplete", [ ApiContractController::class, "incomplete" ]); // 불완전 정보 수신

Route::get("/contract", function () {
    return ["test" => 1];
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
