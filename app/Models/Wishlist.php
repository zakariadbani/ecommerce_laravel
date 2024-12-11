<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *     schema="Wishlist",
 *     type="object",
 *     title="Wishlist",
 *     properties={
 *         @OA\Property(property="user_id", type="integer", example=1),
 *         @OA\Property(property="product_id", type="integer", example=10),
 *     }
 * )
 */
class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
