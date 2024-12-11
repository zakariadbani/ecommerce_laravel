<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @OA\Schema(
 *     schema="Cart",
 *     type="object",
 *     title="Cart",
 *     properties={
 *         @OA\Property(property="user_id", type="integer", example=1),
 *         @OA\Property(property="product_id", type="integer", example=10),
 *         @OA\Property(property="quantity", type="integer", example=2),
 *     }
 * )
 */

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'product_id', 'quantity',
    ];

    /**
     * Relation avec le modèle User.
     * Un panier appartient à un utilisateur.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec le modèle Product.
     * Un panier appartient à un produit.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
