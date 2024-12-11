<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;

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

// Auth routes
Route::post('/account', [AuthController::class, 'register']);
Route::post('/token', [AuthController::class, 'login']);

// Protected routes requiring authentication
Route::middleware('auth:sanctum')->group(function () {
    // Product routes
    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/products', [ProductController::class, 'store'])->middleware('can:can-manage-products');
    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::patch('/products/{id}', [ProductController::class, 'update'])->middleware('can:can-manage-products');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->middleware('can:can-manage-products');

    // Cart routes

    // Route pour ajouter un produit au panier
    Route::post('/carts', [CartController::class, 'addToCart']);
    // Route pour obtenir tous les produits du panier
    Route::get('/carts', [CartController::class, 'getCartItems']);
    // Route pour supprimer un produit du panier
    Route::delete('/carts/{id}', [CartController::class, 'removeFromCart']);

    // Wishlist routes

    // Route pour ajouter un produit à la liste d'envies
    Route::post('/wishlists', [WishlistController::class, 'addToWishlist']);
    // Route pour obtenir tous les produits dans la liste d'envies
    Route::get('/wishlists', [WishlistController::class, 'getWishlistItems']);
    // Route pour supprimer un produit de la liste d'envies
    Route::delete('/wishlists/{id}', [WishlistController::class, 'removeFromWishlist']);

});
