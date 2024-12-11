<?php

namespace App\Policies;

use App\Models\User;

class ProductPolicy
{
    /**
     * Détermine si l'utilisateur peut gérer les produits.
     */
    public function canManageProducts(User $user): bool
    {
        return $user->email === 'admin@admin.com';
    }
}
