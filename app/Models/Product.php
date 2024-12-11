<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *     schema="Product",
 *     type="object",
 *     title="Product",
 *     properties={
 *         @OA\Property(property="code", type="string", example="P001"),
 *         @OA\Property(property="name", type="string", example="Product Name"),
 *         @OA\Property(property="description", type="string", example="Product description."),
 *         @OA\Property(property="image", type="string", format="url", example="https://example.com/image.jpg"),
 *         @OA\Property(property="category", type="string", example="Category Name"),
 *         @OA\Property(property="price", type="number", format="float", example=99.99),
 *         @OA\Property(property="quantity", type="integer", example=100),
 *         @OA\Property(property="internalReference", type="string", example="REF001"),
 *         @OA\Property(property="shellId", type="integer", example=123),
 *         @OA\Property(property="inventoryStatus", type="string", enum={"INSTOCK", "LOWSTOCK", "OUTOFSTOCK"}, example="INSTOCK"),
 *         @OA\Property(property="rating", type="integer", example=5),
 *     }
 * )
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'description',
        'image',
        'category',
        'price',
        'quantity',
        'internalReference',
        'shellId',
        'inventoryStatus',
        'rating',
    ];
}
