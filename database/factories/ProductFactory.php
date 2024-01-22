<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
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
        $title = $this->faker->name();
        $price = rand(1000, 50000);

        return [
            'category_id' => Category::inRandomOrder()->first()->id,
            'title' => $title,
            'alias' => Str::slug($title),
            'price' => $price,
            'price_old' => (rand(0, 100) > 90) ? (int)($price * 1.2) : null,
        ];
    }
}
