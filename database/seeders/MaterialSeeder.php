<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Золото */
        Material::create(['title' => 'Золото'])->children()->createMany([
            ['title' => 'Белое золото'],
            ['title' => 'Красное золото'],
            ['title' => 'Комбинированное золото'],
            ['title' => 'Лимонное золото']
        ]);

        /* Серебро */
        Material::create(['title' => 'Серебро'])->children()->createMany([
            ['title' => 'Золоченое серебро'],
            ['title' => 'Черненое серебро'],
            ['title' => 'Родированное серебро'],
            ['title' => 'Комбинированное серебро']
        ]);

        /* Керамика */
        Material::create(['title' => 'Керамика'])->children()->createMany([
            ['title' => 'Белая'],
            ['title' => 'Черная'],
            ['title' => 'Цветная']
        ]);
    }
}
