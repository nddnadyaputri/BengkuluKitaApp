<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'Makanan' => [
                ['Juada Keras', 18000, 25, 'Kue tradisional khas Bengkulu dengan rasa manis dan tekstur renyah.'],
                ['Lempuk Durian', 35000, 20, 'Olahan durian khas Bengkulu yang legit dan cocok sebagai oleh-oleh.'],
                ['Kue Tat', 25000, 30, 'Kue tradisional Bengkulu dengan isian selai nanas.'],
            ],
            'Minuman' => [
                ['Kopi Bengkulu', 30000, 25, 'Kopi lokal Bengkulu dengan aroma khas dan rasa yang nikmat.'],
                ['Sirup Kalamansi', 28000, 20, 'Sirup jeruk kalamansi yang segar dan cocok diminum dingin.'],
            ],
            'Fashion' => [
                ['Batik Besurek', 95000, 10, 'Kain batik khas Bengkulu dengan motif Besurek.'],
            ],
        ];

        foreach ($data as $categoryName => $products) {
            $category = Category::create([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName),
            ]);

            foreach ($products as $item) {
                Product::create([
                    'category_id' => $category->id,
                    'name' => $item[0],
                    'slug' => Str::slug($item[0]),
                    'price' => $item[1],
                    'stock' => $item[2],
                    'description' => $item[3],
                ]);
            }
        }
    }
}
