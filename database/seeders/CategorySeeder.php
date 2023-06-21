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
            'category_name' => '服',
        ]);
        Category::create([
            'category_name' => '本',
        ]);
        Category::create([
            'category_name' => '家電',
        ]);
        Category::create([
            'category_name' => '楽器',
        ]);
        Category::create([
            'category_name' => 'パソコン・周辺機器',
        ]);
    }
}
