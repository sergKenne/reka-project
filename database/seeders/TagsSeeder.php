<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::insert([
            ['title' => 'Sale'],
            ['title' => 'Хит'],
            ['title' => 'Новинки'],
            ['title' => 'Тренд'],
            ['title' => 'Последний шанс'],
            ['title' => 'Премиум']
        ]);
    }
}
