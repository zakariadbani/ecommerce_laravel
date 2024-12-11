<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ProductController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/products",
     *     summary="Liste des produits",
     *     tags={"Products"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Liste des produits récupérée avec succès",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Product"))
     *     )
     * )
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products, 200);
    }

    /**
     * @OA\Post(
     *     path="/api/products",
     *     summary="Créer un produit",
     *     tags={"Products"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Produit créé avec succès",
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:products,code|max:50',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|url',
            'category' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'internalReference' => 'nullable|string|max:100',
            'shellId' => 'nullable|integer',
            'inventoryStatus' => 'required|in:INSTOCK,LOWSTOCK,OUTOFSTOCK',
            'rating' => 'nullable|integer|min:0|max:5',
        ]);

        $product = Product::create($validated);

        return response()->json($product, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/products/{id}",
     *     summary="Afficher un produit spécifique",
     *     tags={"Products"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID du produit",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Détails du produit récupérés avec succès",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Produit introuvable",
     *     )
     * )
     */
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Produit non trouvé.'], 404);
        }

        return response()->json($product, 200);
    }

    /**
     * @OA\Patch(
     *     path="/api/products/{id}",
     *     summary="Mettre à jour un produit",
     *     tags={"Products"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID du produit",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Produit mis à jour avec succès",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Produit introuvable",
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Produit non trouvé.'], 404);
        }

        $validated = $request->validate([
            'code' => 'sometimes|string|unique:products,code,' . $id . '|max:50',
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|url',
            'category' => 'sometimes|string|max:100',
            'price' => 'sometimes|numeric|min:0',
            'quantity' => 'sometimes|integer|min:0',
            'internalReference' => 'nullable|string|max:100',
            'shellId' => 'nullable|integer',
            'inventoryStatus' => 'sometimes|in:INSTOCK,LOWSTOCK,OUTOFSTOCK',
            'rating' => 'nullable|integer|min:0|max:5',
        ]);

        $product->update($validated);

        return response()->json($product, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/products/{id}",
     *     summary="Supprimer un produit",
     *     tags={"Products"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID du produit",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Produit supprimé avec succès"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Produit introuvable",
     *     )
     * )
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Produit non trouvé.'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Produit supprimé avec succès.'], 200);
    }
}
