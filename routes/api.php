<?php

use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('book', BookController::class)->only(['index', 'show']);
Route::post('login', [LoginController::class, 'login']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('book', BookController::class)->except(['index', 'show']);
});
