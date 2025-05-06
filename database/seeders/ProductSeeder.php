<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $subcategories = Subcategory::all();

        $products = [
            ['subcategory_id' => $subcategories[0]->id, 'name' => 'iPhone 14', 'price' => 799, 'description' => 'Apple smartphone'],
            ['subcategory_id' => $subcategories[0]->id, 'name' => 'Samsung Galaxy', 'price' => 699, 'description' => 'Samsung smartphone'],
            ['subcategory_id' => $subcategories[1]->id, 'name' => 'Dell Laptop', 'price' => 1200, 'description' => 'Dell i5 Laptop'],
            ['subcategory_id' => $subcategories[2]->id, 'name' => 'Men T-Shirt', 'price' => 25, 'description' => 'Cotton T-shirt'],
            ['subcategory_id' => $subcategories[4]->id, 'name' => 'Harry Potter', 'price' => 15, 'description' => 'Fantasy novel'],
        ];
    
        foreach ($products as $product) {
            Product::create($product);
        }
    
    }
}
