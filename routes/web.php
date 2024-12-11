<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

/*Route::post('/account', [AuthController::class, 'register']);
Route::post('/token', [AuthController::class, 'login']);



Route::middleware('auth:sanctum')->group(function () {
    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/products', [ProductController::class, 'store'])->middleware('can:add-products');
    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::patch('/products/{id}', [ProductController::class, 'update'])->middleware('can:edit-products');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->middleware('can:delete-products');
});*/
