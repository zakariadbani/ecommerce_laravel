<?php

// app/Http/Controllers/WishlistController.php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/wishlists",
     *     summary="Add a product to the wishlist",
     *     tags={"Wishlist"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"product_id"},
     *             @OA\Property(property="product_id", type="integer", example=10)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Product added to wishlist"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */
    public function addToWishlist(Request $request)
    {
        // Validation des données de la requête
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        // Recherche si le produit est déjà dans la liste d'envies de l'utilisateur
        $wishlistItem = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        // Si le produit existe déjà dans la liste d'envies, on ne fait rien
        if ($wishlistItem) {
            return response()->json([
                'message' => 'Product already in wishlist'
            ], 200); // Retourner un message que le produit est déjà dans la liste d'envies
        }

        // Sinon, créer un nouvel élément dans la liste d'envies
        $wishlistItem = Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
        ]);

        return response()->json($wishlistItem, 200);  // Retourner le nouvel élément
    }

    /**
     * @OA\Get(
     *     path="/api/wishlists",
     *     summary="Get all products in the wishlist",
     *     tags={"Wishlist"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of wishlist items",
     *     )
     * )
     */
    public function getWishlistItems()
    {
        // Récupérer les éléments de la liste d'envies de l'utilisateur connecté
        $wishlistItems = Wishlist::where('user_id', Auth::id())->get();
        return response()->json($wishlistItems);
    }

    /**
     * @OA\Delete(
     *     path="/api/wishlists/{id}",
     *     summary="Remove a product from the wishlist",
     *     tags={"Wishlist"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Product removed from wishlist"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Wishlist item not found"
     *     )
     * )
     */
    public function removeFromWishlist($id)
    {
        // Trouver l'élément de la liste d'envies
        $wishlistItem = Wishlist::find($id);

        // Vérifier si l'élément existe et appartient à l'utilisateur connecté
        if (!$wishlistItem || $wishlistItem->user_id !== Auth::id()) {
            return response()->json(['error' => 'Item not found or not authorized'], 404);
        }

        // Supprimer l'élément de la liste d'envies
        $wishlistItem->delete();
        return response()->json(['message' => 'Product removed from wishlist'], 200);
    }
}
