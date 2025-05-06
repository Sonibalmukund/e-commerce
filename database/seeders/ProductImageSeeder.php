<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $products = Product::all();

        foreach ($products as $product) {
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => 'images/sample-' . $product->id . '.jpg',
            ]);
        }
    
    }
}
