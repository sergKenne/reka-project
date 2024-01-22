<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $materials = Material::all();
        $tags = Tag::all();

        Product::factory()->count(500)->create()->each(function ($product) use ($materials, $tags)
        {
            /* Закрепляем материалы. */
            $parentMaterial = $materials->where('parent_id', 0)->random();

            if (rand(0, 1)) {
                if (!$parentMaterial->children->isEmpty()) {
                    $product->materials()->sync([$parentMaterial->id, $parentMaterial->children->random()->id]);
                } else {
                    $product->materials()->attach($parentMaterial->id);
                }
            }

            /* Закрепляем теги. */
            $product->tags()->sync($tags->random(rand(0, 2))->pluck('id')->toArray());
        });
    }
}
