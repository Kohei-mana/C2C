<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'category_name' => 'カテゴリA',
        ]);
        Category::create([
            'category_name' => 'カテゴリB',
        ]);
        Category::create([
            'category_name' => 'カテゴリC',
        ]);
        Category::create([
            'category_name' => 'カテゴリD',
        ]);
    }
}
