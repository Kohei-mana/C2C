<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'user_id' => '3',
            'name' => 'Tシャツ',
            'category_id' => '16',
            'image' => '4307.png',
            'price' => '3200',
            'inventory' => '4',
            'product_description' => 'これは白いTシャツです。テストデータです。',
        ]);
        Product::create([
            'user_id' => '3',
            'name' => 'Laravel入門',
            'category_id' => '17',
            'image' => '9784798168654.jpg',
            'price' => '2800',
            'inventory' => '3',
            'product_description' => 'これはLaravel入門です。テストデータです。',
        ]);
        Product::create([
            'user_id' => '3',
            'name' => '洗濯機',
            'category_id' => '18',
            'image' => 'kaden_sentakuki.png',
            'price' => '19800',
            'inventory' => '3',
            'product_description' => 'これは洗濯機です。これはテストデータです。',
        ]);
        Product::create([
            'user_id' => '2',
            'name' => 'ギター',
            'category_id' => '19',
            'image' => '7786.png',
            'price' => '12800',
            'inventory' => '1',
            'product_description' => 'これはギターです。これはテストデータです。',
        ]);
    }
}
