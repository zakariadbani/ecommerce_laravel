<?php
// app/Http/Controllers/CartController.php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/carts",
     *     summary="Add a product to the cart",
     *     tags={"Cart"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"product_id", "quantity"},
     *             @OA\Property(property="product_id", type="integer", example=10),
     *             @OA\Property(property="quantity", type="integer", example=2)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Product added to cart",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */
    public function addToCart(Request $request)
    {
        // Validation des données de la requête
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Recherche si le produit est déjà dans le panier de l'utilisateur
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        // Si le produit existe déjà dans le panier, on ajoute la quantité
        if ($cartItem) {
            // Ajouter la quantité envoyée à la quantité existante
            $cartItem->quantity += $request->quantity;
            $cartItem->save();

            return response()->json($cartItem, 200);  // Retourner l'élément mis à jour
        }

        // Sinon, créer un nouvel élément dans le panier
        $cartItem = Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);

        return response()->json($cartItem, 200);
    }

    /**
     * @OA\Get(
     *     path="/api/carts",
     *     summary="Get all items in the cart",
     *     tags={"Cart"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of cart items",
     *     )
     * )
     */
    public function getCartItems()
    {
        // Récupérer les éléments du panier de l'utilisateur connecté
        $cartItems = Cart::where('user_id', Auth::id())->get();
        return response()->json($cartItems);
    }

    /**
     * @OA\Delete(
     *     path="/api/carts/{id}",
     *     summary="Remove a product from the cart",
     *     tags={"Cart"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Product removed from cart"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Cart item not found"
     *     )
     * )
     */
    public function removeFromCart($id)
    {
        // Trouver l'élément du panier
        $cartItem = Cart::find($id);

        // Vérifier si l'élément existe et appartient à l'utilisateur connecté
        if (!$cartItem || $cartItem->user_id !== Auth::id()) {
            return response()->json(['error' => 'Item not found or not authorized'], 404);
        }

        // Supprimer l'élément du panier
        $cartItem->delete();
        return response()->json(['message' => 'Product removed from cart'], 200);
    }
}
