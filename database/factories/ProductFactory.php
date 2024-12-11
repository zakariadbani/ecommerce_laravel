<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => strtoupper(Str::random(10)), // Random 10 character code
            'name' => $this->faker->word(),
            'description' => $this->faker->paragraph(),
            'image' => $this->faker->imageUrl(),
            'category' => $this->faker->word(),
            'price' => $this->faker->randomFloat(2, 10, 1000), // Random price between 10 and 1000
            'quantity' => $this->faker->numberBetween(1, 100), // Random quantity between 1 and 100
            'internalReference' => strtoupper(Str::random(8)), // Random 8 character reference
            'shellId' => $this->faker->randomNumber(5), // Random shell ID, 5 digits
            'inventoryStatus' => $this->faker->randomElement(['INSTOCK', 'LOWSTOCK', 'OUTOFSTOCK']),
            'rating' => $this->faker->randomFloat(1, 1, 5), // Random rating between 1 and 5
        ];
    }

    /**
     * Indicate that the product is out of stock.
     */
    public function outOfStock(): static
    {
        return $this->state(fn (array $attributes) => [
            'inventoryStatus' => 'OUTOFSTOCK',
            'quantity' => 0,
        ]);
    }

    /**
     * Indicate that the product is low on stock.
     */
    public function lowStock(): static
    {
        return $this->state(fn (array $attributes) => [
            'inventoryStatus' => 'LOWSTOCK',
            'quantity' => $this->faker->numberBetween(1, 10),
        ]);
    }

    /**
     * Indicate that the product is in stock.
     */
    public function inStock(): static
    {
        return $this->state(fn (array $attributes) => [
            'inventoryStatus' => 'INSTOCK',
            'quantity' => $this->faker->numberBetween(50, 100),
        ]);
    }
}
