<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Create an admin user
        User::factory()->create([
            'username' => 'adminuser',
            'firstname' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'), // Replace with a secure password
        ]);

        // Create a regular user
        User::factory()->create([
            'username' => 'regularuser',
            'firstname' => 'Regular',
            'email' => 'user@example.com',
            'password' => Hash::make('password'), // Replace with a secure password
        ]);

// Create 10 product that is in stock
        Product::factory()->count(10)->inStock()->create();
// Create 1 out-of-stock product
        Product::factory()->outOfStock()->create();
// Create 1 product with low stock
        Product::factory()->lowStock()->create();

    }
}
