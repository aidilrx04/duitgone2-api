<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::as('api.')->group(function () {
    Route::apiResource('transactions', TransactionController::class);
    Route::apiResource('categories', CategoryController::class);
});
