<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert([
            ['title' => 'Кольца'],
            ['title' => 'Серьги'],
            ['title' => 'Браслеты'],
            ['title' => 'Броши'],
            ['title' => 'Колье'],
            ['title' => 'Цепи'],
            ['title' => 'Часы']
        ]);
    }
}
